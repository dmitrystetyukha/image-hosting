<?php
namespace app\view;

use app\db\model\Comment;

class CommentView
{
    public static function getCommentListElement(Comment $comment)
    {
        $user        = $comment->getUser();
        $username    = $user->getName();
        $commentText = $comment->getCommentText();

        return <<<COMMENTELEMENT
        <li>
            <p>$username: $commentText</p>
        </li>
        COMMENTELEMENT;
    }

    public static function getCommentList(array $comments)
    {
        $html = '<ul>';

        foreach ($comments as $comment) {
            $html .= self::getCommentListElement($comment);
        }

        $html .= '</ul>';

        return $html;
    }
}