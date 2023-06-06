<?php
namespace app\db\usecase;

use app\db\model\Picture;
use app\db\repository\base\BasePicture;


class PictureUseCase
{
    private BasePicture $pictures;

    public function __construct(BasePicture $pictures)
    {
        $this->pictures = $pictures;
    }

    public function getById(string $id)
    {
        return $this->getById($id);
    }

    public function getByHash(string $md5Hash)
    {
        return $this->getByHash($md5Hash);
    }

    public function uploadPicture(Picture $picture)
    {
        $this->pictures->create($picture);
    }

    public function getPictureList(): array
    {
        return $this->pictures->getAllPictures();
    }

}