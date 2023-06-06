<?php
namespace app\controller;

use app\db\model\User;
use app\db\repository\UserNotExistException;
use app\db\usecase\UserUseCase;

use auth\RegisterFailException;

use app\utils\ErrorMessage;
use app\utils\UUID;

class UserController
{
    private UserUseCase $userUseCase;

    public function __construct(UserUseCase $userUseCase)
    {
        $this->userUseCase = $userUseCase;
    }

    public function login(string $name, string $password)
    {
        $user = $this->userUseCase->verifyUser($name, $password);

        if (is_null($user)) {
            # code...
        }
        else {
            $_SESSION['user'] = $user;
        }


    }

    public function logout()
    {
        if (isset($_SESSION['loggedin'])) {
            unset($_SESSION['user']);
            unset($_SESSION['loggedin']);

            session_unset();
            session_destroy();
            die;
        }
        else {
            header('Location: /');
            die;
        }
    }

    public function register()
    {
        if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['password2'])) {

            $username  = $_POST['username'];
            $password  = $_POST['password'];
            $password2 = $_POST['password2'];

            if ($password !== $password2) {
                ErrorMessage::setErrorMessage('Пароли не совпадают.');
                header('Location: /register');
                die;
            }

            if (strlen($password) < 8) {
                ErrorMessage::setErrorMessage('Пароль должен содержать как минимум 8 символов.');
                header('Location: /register');
                die;
            }

            if (!preg_match('/\d/', $password) || !preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password)) {
                ErrorMessage::setErrorMessage('Пароль должен содержать как минимум одну цифру, одну заглавную и одну маленькую латинские буквы.');
                header('Location: /register');
                die;
            }

            try {
                require_once __DIR__ . '/app/auth/register-user.php';

                $user = new User(UUID::v4(), $username, password_hash($password, PASSWORD_BCRYPT));

                try {
                    $this->userUseCase->register($user);
                }
                catch (UserNotExistException $ex) {
                    throw $ex;
                }
                header('Location: /login');
                die;
            }
            catch (RegisterFailException $exception) {
                ErrorMessage::setErrorMessage($exception->getMessage());
                header('Location: /register');
                die;
            }
        }
        else {
            ErrorMessage::setErrorMessage('Все поля обязательны для заполнения.');
            header('Location: /register');
            die;
        }
    }

}