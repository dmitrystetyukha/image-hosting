<?php

use app\auth\RegisterFailException;
use app\repository\ConnectionFailException;
use app\repository\DBConnection;

require_once __DIR__ . '/app/config.php';
require_once __DIR__ . '/app/boot.php';

require_once __DIR__ . '/app/utils/error-message.php';


$token                  = bin2hex(random_bytes(32));
$_SESSION['csrf_token'] = $token;


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['password2'])) {

        if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['password2'])) {

            $username  = $_POST['username'];
            $password  = $_POST['password'];
            $password2 = $_POST['password2'];

            if ($password !== $password2) {
                setErrorMessage('Пароли не совпадают.');
                header('Location: register.php');
                die;
            }

            if (strlen($password) < 8) {
                setErrorMessage('Пароль должен содержать как минимум 8 символов.');
                header('Location: register.php');
                die;
            }

            if (!preg_match('/\d/', $password) || !preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password)) {
                setErrorMessage('Пароль должен содержать как минимум одну цифру, одну заглавную и одну маленькую латинские буквы.');
                header('Location: register.php');
                die;
            }

            try {
                require_once __DIR__ . '/app/repository/get-connection.php';

                $dbConnection = getDBConnection();
            }
            catch (ConnectionFailException $exception) {
                setErrorMessage($exception->getMessage());
                header('Location: register.php');
                die;
            }

            try {
                require_once __DIR__ . '/app/auth/register-user.php';

                registerUser($dbConnection, $_POST['username'], $password);

                header('Location: login.php');
                die;
            }
            catch (RegisterFailException $exception) {
                setErrorMessage($exception->getMessage());
                header('Location: register.php');
                die;
            }
        }
        else {
            setErrorMessage('Все поля обязательны для заполнения.');
            header('Location: register.php');
            die;
        }
    }
}
?>

<html lang="ru">
<?php require_once __DIR__ . '/app/templates/head.php' ?>

<body>
    <?php require_once __DIR__ . '/app/templates/navbar.php' ?>

    <?php require_once __DIR__ . '/app/templates/register-form.php' ?>

    <?php getErrorMessage() ?>

    <p><a href="/login.php">Есть аккаунт, войти</a></p>

</body>

</html>