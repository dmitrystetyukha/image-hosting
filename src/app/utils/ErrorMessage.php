<?php
namespace app\utils;

class ErrorMessage
{
    public static function setErrorMessage(string $message)
    {
        $_SESSION['errorMessage'] = $message;
    }

    public static function getErrorMessage()
    {
        if (!empty($_SESSION['errorMessage'])) { ?>
            <h5>
                <?= $_SESSION['errorMessage'] ?>
            </h5>
        <?php }
        unset($_SESSION['errorMessage']);
    }
}