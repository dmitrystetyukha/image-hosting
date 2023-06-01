<?php

namespace app\auth;

use Exception;

class LoginFailException extends Exception
{

    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $message = "Не удалось авторизоваться. $message";

        parent::__construct($message, $code, $previous);
    }

}