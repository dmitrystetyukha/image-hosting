<?php

namespace app\repository;

use PDOException;

class ConnectionFailException extends PDOException
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $message = "Проблема при подключении к БД. $message";

        parent::__construct ($message, $code, $previous);
    }
}