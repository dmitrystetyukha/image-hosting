<?php
namespace auth;

use Exception;
use Throwable;

class LoginFailException extends Exception
{

    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $message = "Не удалось авторизоваться. $message";

        parent::__construct($message, $code, $previous);
    }

}

class RegisterFailException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $message = "Не удалось зарегистрироваться. $message";

        parent::__construct($message, $code, $previous);
    }

}