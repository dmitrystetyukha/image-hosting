<?php

namespace app\models;

class User
{

    private string $id;
    private string $name;
    private string $password;
    private string $salt;

    public function __construct(string $id, string $username, string $password, string $salt)
    {

        $this->id       = $id;
        $this->name     = $username;
        $this->password = $password;
        $this->salt     = $salt;
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

    /**
     * @return string
     */
    public function getSalt(): string
    {
        return $this->salt;
    }

}