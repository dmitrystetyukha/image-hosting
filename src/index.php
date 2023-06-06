<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/app/config.php';

use app\controller\CommentController;
use app\controller\PictureController;
use app\controller\UserController;

use app\db\repository\mysql\MysqlComment;
use app\db\repository\mysql\MysqlPicture;
use app\db\repository\mysql\MysqlUser;
use app\db\usecase\CommentUseCase;
use app\db\usecase\PictureUseCase;
use app\db\usecase\UserUseCase;

use app\Router;
use app\utils\ErrorMessage;

session_start();

$_SESSION['last_action'] = time();


$requestUri = $_SERVER['REQUEST_URI'];

$connection = new PDO(sprintf('mysql:host=%s;dbname=%s', DB_HOST, DB_NAME), DB_USER, DB_PASSWORD);

$mysqlUsers    = new MysqlUser($connection);
$mysqlPictures = new MysqlPicture($connection);
$mysqlComments = new MysqlComment($connection);

$userUseCase    = new UserUseCase($mysqlUsers);
$pictureUsecase = new PictureUseCase($mysqlPictures);
$commentUsecase = new CommentUseCase($mysqlComments);


$userController    = new UserController($userUseCase);
$commentController = new CommentController($commentUsecase);
$pictureController = new PictureController($pictureUsecase, $commentController);

$router = new Router($userController, $pictureController, $commentController);

?>

<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Image Hosting</title>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <nav>
        <a href="<?php echo BASE_URI ?>">Главная страница</a>
        <a href="<?php echo BASE_URI . '/upload-picture.php' ?>">Загрузить картинку</a>
        <?php
        if (isset($_SESSION['loggedin'])) {
            echo '<p>' . $_SESSION['username'] . '</p>' . '|' . '<form method="post" action="/logout"><button type="submit">Выход</button></form>';
        }
        else {
            echo '<a href="' . BASE_URI . '/login"' . '>Авторизация</a>';
        }
        ?>
    </nav>

    <?php
    echo $router->getResponse();

    echo $_SERVER['REQUEST_URI'];

    ErrorMessage::getErrorMessage();
    ?>

</body>

</html>