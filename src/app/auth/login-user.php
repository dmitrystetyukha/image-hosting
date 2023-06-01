<?php

require_once __DIR__ . '/LoginFailException.php';

require_once __DIR__ . '/../repository/DBConnection.php';
require_once __DIR__ . '/../repository/QueryExequtionFailException.php';

use app\auth\LoginFailException;

use app\repository\DBConnection;
use app\repository\QueryExequtionFailException;


/**
 * @throws LoginFailException
 */
function loginUser(DBConnection $connection, string $username, string $password)
{

    try {

        $sql = 'SELECT * FROM `users` WHERE `name`=:username';

        $stmt = $connection->prepare($sql);

        $stmt->execute(['username' => $username]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result !== null && count($result) !== 0) {

            if (password_verify($password . $result['salt'] . $password, $result['password'])) {

                $_SESSION['user-id']  = $result['id'];
                $_SESSION['username'] = $result['name'];
                $_SESSION['loggedin'] = true;
            }
            else {
                throw new LoginFailException('Неправильный пароль.');
            }
        }
        else {
            throw new LoginFailException('Такого имени нет в системе.');
        }

    }
    catch (QueryExequtionFailException $exception) {
        throw new LoginFailException($exception->getMessage());
    }
}