<?php
namespace app\db\model;

use app\utils\UUID;

class User
{

    private string $id;
    private string $name;
    private string $password;

    public function __construct(?string $id, string $name, string $password)
    {
        $this->id       = (is_null($id)) ? UUID::v4() : $id;
        $this->name     = $name;
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
}