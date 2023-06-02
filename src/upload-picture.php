<?php
require_once __DIR__ . '/app/config.php';
require_once __DIR__ . '/app/boot.php';

require_once __DIR__ . '/app/utils/error-message.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_FILES['pictureFile'])) {
        $fileInfo = new SplFileInfo($_FILES['pictureFile']);

        if ($fileInfo->getExtension() === 'jpg' | $fileInfo->getExtension() === 'jpg') {

        }
        else {
            setErrorMessage('Неправильный файл. Доступны только jpg и png.');
        }
    }
}

?>

<html lang="ru">
<?php require_once __DIR__ . '/app/templates/head.php' ?>

<body>

    <?php require_once __DIR__ . '/app/templates/navbar.php' ?>
    <?php if ($_SESSION['loggedin']) { ?>
        <form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
            <p><input type="file" name="pictureFile">
                <input type="submit" value="Загрузить ">
            </p>
        </form>
        <?php
    }
    else {
        echo '<h3>Вам нужно авторизоваться, чтобы загружать картинки на сайт.</h3>';
    }
    ?>
</body>

</html>