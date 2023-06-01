<?php
function logoutUser()
{
    unset($_SESSION['user_id']);
    unset($_SESSION['username']);
    unset($_SESSION['loggedin']);

    session_unset();
    session_destroy();
    die;
}