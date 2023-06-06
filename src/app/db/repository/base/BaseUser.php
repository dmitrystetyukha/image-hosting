<?php
namespace app\db\repository\base;

use app\db\model\User;
use PDO;

abstract class BaseUser
{
    private PDO $connection;

    abstract public function getById(string $id): User;
    abstract public function getByName(string $name): User;

    abstract public function create(User $newUser);

}