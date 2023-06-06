<?php

namespace app\db\repository\base;

use app\db\model\Picture;
use PDO;

abstract class BasePicture
{
    private PDO $connection;

    abstract public function getById(string $id): Picture;
    abstract public function getByHash(string $mdHash): Picture;

    abstract public function getAllPictures(): array;

    abstract public function create(Picture $newPicture);
}