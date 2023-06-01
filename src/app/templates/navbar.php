<nav>
    <a href="<?php echo BASE_URI ?>">Главная страница</a>
    <a href="<?php echo BASE_URI . '/upload-picture.php' ?>">Загрузить картинку</a>
    <?php
    if (isset($_SESSION['loggedin'])) {
        echo '<p>' . $_SESSION['username'] . '</p>' . '|' . '<form method="post" action="logout.php"><button type="submit">Выход</button></form>';
    }
    else {
        echo '<a href="' . BASE_URI . '/login.php"' . '>Авторизация</a>';
    }
    ?>

</nav>