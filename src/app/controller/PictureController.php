<?php
namespace app\controller;

use app\db\usecase\PictureUseCase;
use \app\view\PictureView;

class PictureController
{
    private PictureUseCase $pictureUseCase;
    private CommentController $commentController;

    public function __construct(PictureUseCase $pictureUseCase, CommentController $commentController)
    {
        $this->pictureUseCase    = $pictureUseCase;
        $this->commentController = $commentController;
    }

    public function getPictureList(): string
    {
        return PictureView::getPictureList($this->pictureUseCase->getPictureList());
    }

    public function getPictureDetail(string $pictureId)
    {
        $picture     = $this->pictureUseCase->getById($pictureId);
        $commentList = $this->commentController->getByPicture($pictureId);
        PictureView::getPictureDetail($picture, $commentList);
    }
}