<?php
require_once __DIR__ . '/DBConnection.php';
require_once __DIR__ . '/ConnectionFailException.php';

use app\repository\ConnectionFailException;
use app\repository\DBConnection;

function getDBConnection()
{
    try {
        return new DBConnection(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);
    }
    catch (PDOException $ex) {
        throw new ConnectionFailException();
    }
}