<?php
namespace app\db\usecase;

use app\db\model\Comment;
use app\db\model\Picture;
use app\db\model\User;
use app\db\repository\base\BaseComment;

class CommentUseCase
{

    private BaseComment $comments;

    public function __construct(BaseComment $comments)
    {
        $this->comments = $comments;
    }

    public function getById(string $id): Comment
    {
        return $this->comments->getById($id);
    }

    public function getByUser(User $user): array
    {
        return $this->comments->getByUser($user);
    }

    public function getByPicture(string $pictureId): array
    {
        return $this->comments->getByPicture($pictureId);
    }

    public function create(Comment $newComment)
    {
        $this->comments->create($newComment);
    }

    public function delete(string $id)
    {
        $this->comments->delete($id);
    }

    public function update(string $id, string $newCommentText)
    {
        $this->comments->update($id, $newCommentText);
    }
}