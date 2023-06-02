<?php
use app\auth\LoginFailException;
use app\repository\ConnectionFailException;
use app\repository\DBConnection;

require_once __DIR__ . '/app/config.php';
require_once __DIR__ . '/app/boot.php';

require_once __DIR__ . '/app/utils/error-message.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['username']) && isset($_POST['password'])) {

        if (!empty($_POST['username']) && !empty($_POST['password'])) {

            try {
                require_once __DIR__ . '/app/repository/get-connection.php';

                $dbConnection = getDBConnection();
            }
            catch (ConnectionFailException $exception) {
                setErrorMessage($exception->getMessage());
                die;
            }

            try {
                require_once __DIR__ . '/app/auth/login-user.php';

                loginUser($dbConnection, $_POST['username'], $_POST['password']);

                header('Location: index.php');
                die;
            }
            catch (LoginFailException $exception) {
                setErrorMessage($exception->getMessage());
                header('Location: login.php');
                die;
            }
        }
        else {
            setErrorMessage('Все поля обязательны для заполнения');
            header('Location: login.php');
            die;
        }
    }
}
?>

<html lang="ru">
<?php require_once __DIR__ . '/app/templates/head.php' ?>

<body>
    <?php require_once __DIR__ . '/app/templates/navbar.php' ?>
    <?php require_once __DIR__ . '/app/templates/login-form.php' ?>
    <?php
    getErrorMessage();
    ?>

    <p><a href="/register.php">Нет аккаунта, зарегистрироваться</a></p>
</body>

</html>