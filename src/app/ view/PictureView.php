<?php
namespace app\view;

use app\db\model\Picture;

class PictureView
{

    public static function getPictureListElement(Picture $picture): string
    {
        $html = '<div>';
        $html .= sprintf('<h2>%s</h2>', $picture->getName());
        $html .= sprintf('<img src="%s" alt="%s" width="100px" height="auto">', BASE_URI . $picture->getFilePath(), strtolower($picture->getUser()->getName()));
        $html .= '<div>';
        $html .= sprintf('<p>%s</p>', ucfirst($picture->getDescription()));
        $html .= '</div>';
        $html .= '<ul>';
        $html .= sprintf('<li>Автор: %s</li>', ucfirst($picture->getUser()->getName()));
        $html .= sprintf('<li>Просмотры: %s</li>', $picture->getNumOfViews());
        $html .= sprintf('<li>Комментарии: %s</li>', $picture->getNumOfComments());
        $html .= '</ul>';
        $html .= '<div>';
        $html .= sprintf('<a href="%s">Подробнее</a>', BASE_URI . '/picture-detail.php?id=' . $picture->getID());
        $html .= sprintf('<p>Опубликовано %s</p>', $picture->getUploadTime()->format('d.m.y H:i'));
        $html .= '</div>';
        $html .= '</div>';

        return $html;
    }

    public static function getPictureList(array $pictures): string
    {
        $html = '<ul>';
        foreach ($pictures as $picture) {
            $html .= self::getPictureListElement($picture);
        }
        $html .= '</ul>';
        return $html;
    }

    public static function getPictureDetail(Picture $picture, string $commentList)
    {
        $id            = $picture->getID();
        $name          = ucfirst($picture->getName());
        $filePath      = $picture->getFilePath();
        $description   = ucfirst($picture->getDescription());
        $numOfViews    = $picture->getNumOfViews();
        $uploadTime    = $picture->getUploadTime()->format('d.m.Y в H:i');
        $numOfComments = $picture->getNumOfComments();

        return <<<PICTUREDETAIL
        <div>
            <img src="$filePath" alt="img-$id">
            <h2>$name</h2>
            <p>Описание: $description</p>
            <p>Автор: </p>
            <p>Загружено: $uploadTime</p>
            <p>Просмотров: $numOfViews</p>
            <h3>Комментарии ($numOfComments)</h3>
            $commentList
        </div>
        PICTUREDETAIL;
    }


}