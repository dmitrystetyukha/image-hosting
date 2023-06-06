<?php

namespace app\db\repository\base;

use app\db\model\Comment;
use app\db\model\Picture;
use app\db\model\User;

use PDO;

abstract class BaseComment
{
    private PDO $connection;

    abstract public function getById(string $id): Comment;
    abstract public function getByUser(User $user): array;
    abstract public function getByPicture(string $pictureId): array;

    abstract public function create(Comment $newComment);
    abstract public function delete(string $id);
    abstract public function update(string $id, string $newCommentText);

}