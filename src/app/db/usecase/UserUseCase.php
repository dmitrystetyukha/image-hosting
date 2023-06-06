<?php
namespace app\db\usecase;

use app\db\model\User;
use \app\db\repository\base\BaseUser;

class UserUseCase
{

    private BaseUser $users;

    public function __construct(BaseUser $users)
    {
        $this->users = $users;
    }

    public function getById(string $id): User
    {
        return $this->getById($id);
    }
    public function getByName(string $name): User
    {
        return $this->getByName($name);
    }
    public function register(User $newUser): User
    {
        return $this->users->create($newUser);
    }

    public function verifyUser(string $name, string $password)
    {
        $user = $this->users->getByName($name);

        return (password_verify($password, $user->getPassword())) ? $user : null;
    }
}