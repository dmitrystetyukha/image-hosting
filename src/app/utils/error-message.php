<?php

function setErrorMessage(string $message)
{
    $_SESSION['errorMessage'] = $message;
}

function getErrorMessage()
{
    if (!empty($_SESSION['errorMessage'])) { ?>
        <h5>
            <?= $_SESSION['errorMessage'] ?>
        </h5>
    <?php }
    unset($_SESSION['errorMessage']);
}