<?php

namespace app\repository;

use PDO;
use PDOException;

class DBConnection extends PDO
{

    public function __construct(string $dbHost, string $dbName, string $dbUser, string $dbPassword, ?array $options = null)
    {
        $dsn = "mysql:host=$dbHost;dbname=$dbName;charset=utf8mb4";
        parent::__construct($dsn, $dbUser, $dbPassword, $options);
    }

    public function query($query, $fetchMode = PDO::ATTR_DEFAULT_FETCH_MODE, $arg3 = null, $ctorargs = [])
    {
        try {
            parent::query($query, $fetchMode, $arg3, $ctorargs);
        } catch (PDOException $ex) {
            throw new QueryExequtionFailException();
        }
    }
}