<?php
namespace app\db\repository;

use Exception;
use Throwable;

class ConnectionFailException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $message = "Проблема при подключении к БД. $message";

        parent::__construct($message, $code, $previous);
    }
}

class QueryExequtionFailException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $message = "Проблема при выполнении запроса. $message";

        parent::__construct($message, $code, $previous);
    }

}

class UserAlreadyExistException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $message = "Имя занято. $message";
        parent::__construct($message, $code, $previous);
    }
}

class UserNotExistException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $message = "Имя отсутствует в системе. $message";
        parent::__construct($message, $code, $previous);
    }
}

class PictureNotExistException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $message = "Картинка отсутствует в системе. $message";
        parent::__construct($message, $code, $previous);
    }
}

class PictureAlreadyExistException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $message = "Картинка уже в системе. Вы сможете загрузить ее позднее, чем через 5 минут после загрузки предыдущей. $message";
        parent::__construct($message, $code, $previous);
    }
}

class CommentNotExistException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $message = "Комментарий отсутствует в системе. $message";
        parent::__construct($message, $code, $previous);
    }
}