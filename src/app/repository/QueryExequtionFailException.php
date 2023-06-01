<?php

namespace app\repository;

use PDOException;

class QueryExequtionFailException extends PDOException
{

    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $message = "Проблема при выполнении запроса. $message";

        parent::__construct($message, $code, $previous);
    }

}