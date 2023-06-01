<?php

namespace app\auth;

use Exception;

class RegisterFailException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $message = "Не удалось зарегистрироваться. $message";

        parent::__construct($message, $code, $previous);
    }

}