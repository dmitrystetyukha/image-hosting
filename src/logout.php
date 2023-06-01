<?php
require_once __DIR__ . '/app/config.php';
require_once __DIR__ . '/app/boot.php';

require_once __DIR__ . '/app/auth/logout-user.php';

if (isset($_SESSION['loggedin'])) {
    header('Location: index.php');
    logoutUser();
    die;
}
else {
    header('Location: index.php');
    die;
}