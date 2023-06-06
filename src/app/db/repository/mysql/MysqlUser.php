<?php

namespace app\db\repository\mysql;

use app\db\model\User;
use app\db\repository\base\BaseUser;
use app\db\repository\QueryExequtionFailException;
use app\db\repository\UserNotExistException;
use PDO;
use PDOException;
use TypeError;

class MysqlUser extends BaseUser
{
    private PDO $connection;

    /**
     * @param PDO $connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param mixed $id
     * @return User
     * @throws UserNotExistException
     * @throws QueryExequtionFailException
     */
    public function getById(string $id): User
    {
        $sql = '$SELECT * FROM `users` WHERE `id`=:id';

        $stmt = $this->connection->prepare($sql);

        try {
            $stmt->execute(['$id' => $id]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (PDOException $ex) {
            throw new QueryExequtionFailException('Ошибка выполнения запроса.');
        }

        try {
            $numOfResultRows = count($result);
        }
        catch (TypeError $err) {
            throw new QueryExequtionFailException('Запрос вернул 0 значений.');
        }

        if ($numOfResultRows !== 0) {
            return new User($result['id'], $result['name'], $result['password']);
        }
        else {
            throw new UserNotExistException();
        }
    }

    /**
     * @param mixed $name
     * @return User
     * @throws UserNotExistException
     * @throws QueryExequtionFailException
     */
    public function getByName(string $name): User
    {
        $sql = 'SELECT * FROM `users` WHERE `name`=:name';

        $stmt = $this->connection->prepare($sql);

        try {
            $stmt->execute(['name' => $name]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (PDOException $ex) {
            throw new QueryExequtionFailException('Ошибка выполнения запроса.');
        }

        try {
            $numOfResultRows = count($result);
        }
        catch (TypeError $err) {
            throw new QueryExequtionFailException('Запрос вернул 0 значений.');
        }

        if ($numOfResultRows !== 0) {
            return new User($result['id'], $result['name'], $result['password']);
        }
        else {
            throw new UserNotExistException();
        }
    }

    /**
     * @param User $newUser
     * @return void
     * @throws QueryExequtionFailException
     */
    public function create(User $newUser)
    {

        try {
            $this->getByName($newUser->getName());
        }
        catch (UserNotExistException $ex) {
            try {
                $sql = 'INSERT INTO `users` (`id`, `name`, `password`) VALUES (:id, :name, :password);';

                $stmt = $this->connection->prepare($sql);
                $stmt->execute(
                    [
                        'id'       => $newUser->getId(),
                        'name'     => $newUser->getName(),
                        'password' => $newUser->getPassword()
                    ]
                );
                return;
            }
            catch (PDOException $ex) {
                throw new QueryExequtionFailException('Ошибка выполнения запроса.');
            }
        }
    }

}