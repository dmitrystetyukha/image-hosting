<?php

require_once __DIR__ . '/RegisterFailException.php';

require_once __DIR__ . '/../model/User.php';

require_once __DIR__ . '/../repository/DBConnection.php';
require_once __DIR__ . '/../repository/QueryExequtionFailException.php';

require_once __DIR__ . '/../utils/UUID.php';

use app\auth\RegisterFailException;
use app\repository\ConnectionFailException;
use app\repository\DBConnection;
use app\repository\QueryExequtionFailException;

/**
 * @throws RegisterFailException
 */
function registerUser(DBConnection $connection, $username, $password)
{

    try {
        $sql = 'SELECT * FROM `users` WHERE `name`=:username';

        $stmt = $connection->prepare($sql);

        $stmt->execute(['username' => $username]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        try {
            $numOfResult = count($result);
        }
        catch (TypeError $err) {
            throw new RegisterFailException('Проблемы с БД.');
        }

        if ($numOfResult === 0) {
            $id       = UUID::v4();
            $salt     = bin2hex(random_bytes(32));
            $password = password_hash($password . $salt . $password, PASSWORD_BCRYPT);

            $sql = 'INSERT INTO `users` (`id`, `name`, `password`, salt) VALUES (:id, :username, :password, :salt)';

            try {
                $stmt = $connection->prepare($sql);
                $stmt->execute(['id' => $id, 'username' => $username, 'password' => $password, 'salt' => $salt]);
            }
            catch (QueryExequtionFailException $exception) {
                throw new RegisterFailException($exception->getMessage());
            }
        }
        else {
            throw new RegisterFailException('Имя пользователя занято.');
        }
    }
    catch (ConnectionFailException $exception) {
        throw new RegisterFailException('Нет доступа к БД.');
    }
}