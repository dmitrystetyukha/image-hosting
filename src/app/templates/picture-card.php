<?php

use app\models\Picture;

function getPictureCard(Picture $picture): string
{
    $html = '<div>';
    $html .= sprintf ('<h2>%s</h2>', $picture->getName ());
    $html .= sprintf ('<img src="%s" alt="%s" width="100px" height="auto">', BASE_URI . $picture->getFilePath (), strtolower ($picture->getUser ()->getName ()));
    $html .= '<div>';
    $html .= sprintf ('<p>%s</p>', ucfirst ($picture->getDescription ()));
    $html .= '</div>';
    $html .= '<ul>';
    $html .= sprintf ('<li>Автор: %s</li>', ucfirst ($picture->getUser ()->getName ()));
    $html .= sprintf ('<li>Просмотры: %s</li>', $picture->getNumOfViews ());
    $html .= sprintf ('<li>Комментарии: %s</li>', $picture->getNumOfComments ());
    $html .= '</ul>';
    $html .= '<div>';
    $html .= sprintf ('<a href="%s">Подробнее</a>', BASE_URI . '/picture-detail.php?id=' . $picture->getID ());
    $html .= sprintf ('<p>Опубликовано %s</p>', $picture->getUploadTime ()->format ('d.m.y H:i'));
    $html .= '</div>';
    $html .= '</div>';

    return $html;
}