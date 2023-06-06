<?php
namespace app\controller;

use app\db\model\Comment;
use app\db\usecase\CommentUseCase;
use CommentView;

class CommentController
{
    private CommentUseCase $commentUseCase;
    public function __construct(CommentUseCase $commentUseCase)
    {
        $this->commentUseCase = $commentUseCase;
    }

    public function getByPicture(string $pictureId): string
    {
        return CommentView::getCommentList($this->commentUseCase->getByPicture($pictureId));
    }

}