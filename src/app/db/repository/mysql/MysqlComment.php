<?php
namespace app\db\repository\mysql;

use app\db\model\Comment;
use app\db\model\Picture;
use app\db\model\User;

use app\db\repository\base\BaseComment;

use app\db\repository\CommentNotExistException;
use app\db\repository\PictureNotExistException;
use app\db\repository\QueryExequtionFailException;
use app\db\repository\UserNotExistException;
use DateTime;
use PDO;
use PDOException;
use TypeError;


class MysqlComment extends BaseComment
{
    private PDO $connection;
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function getById(string $id): Comment
    {
        $sql = 'SELECT * FROM `comments` WHERE `id`=:id;';

        $stmt = $this->connection->prepare($sql);

        try {
            $stmt->execute(['id' => $id]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (PDOException $ex) {
            throw new QueryExequtionFailException('Ошибка выполнения запроса.');
        }

        try {
            $numOfResultRows = count($result);
        }
        catch (TypeError $err) {
            throw new QueryExequtionFailException('Запрос вернул 0 значений.');
        }

        if ($numOfResultRows !== 0) {
            try {
                $user = new MysqlUser($this->connection);
                $user = $user->getById($result['user_id']);
            }
            catch (UserNotExistException $ex) {
                throw new CommentNotExistException($ex->getMessage());
            }

            $picture = new MysqlPicture($this->connection);

            try {
                $picture = $picture->getById($result['picture_id']);
            }
            catch (PictureNotExistException $ex) {
                throw new CommentNotExistException($ex->getMessage());
            }

            return new Comment(
                $result['id'],
                $user,
                $picture, $result['comment_text'], $result['edited'],
                new DateTime($result['creation_time']),
                new DateTime($result['updatetime'])
            );
        }
        else {
            throw new CommentNotExistException();
        }
    }

    /**
     * @param User $user
     * @throws QueryExequtionFailException
     * @throws CommentNotExistException
     * @return Comment
     */
    public function getByUser(User $user): array
    {
        $sql = 'SELECT * FROM `comments` WHERE `user_id`=:user_id;';

        $stmt = $this->connection->prepare($sql);

        try {
            $stmt->execute(['user_id' => $user->getId()]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (PDOException $ex) {
            throw new QueryExequtionFailException('Ошибка выполнения запроса.');
        }

        try {
            $numOfResultRows = count($result);
        }
        catch (TypeError $err) {
            throw new QueryExequtionFailException('Запрос вернул 0 значений.');
        }

        if ($numOfResultRows !== 0) {

            $commentlist = [];

            foreach ($result as $row) {
                try {
                    $user = new MysqlUser($this->connection);
                    $user = $user->getById($row['user_id']);
                }
                catch (UserNotExistException $ex) {
                    throw new CommentNotExistException($ex->getMessage());
                }

                $picture = new MysqlPicture($this->connection);

                try {
                    $picture = $picture->getById($row['picture_id']);
                }
                catch (PictureNotExistException $ex) {
                    throw new CommentNotExistException($ex->getMessage());
                }

                $comment = new Comment(
                    $row['id'],
                    $user,
                    $picture, $row['comment_text'], $row['edited'],
                    new DateTime($row['creation_time']),
                    new DateTime($row['updatetime'])
                );

                array_push($commentlist, $comment);

                return $commentlist;
            }
        }
        else {
            throw new CommentNotExistException();
        }
    }

    /**
     * @param Picture $picture
     * @throws QueryExequtionFailException
     * @throws CommentNotExistException
     * @return Comment
     */
    public function getByPicture(string $pictureId): array
    {
        $sql = 'SELECT * FROM `comments` WHERE `picture_id`=:picture_id;';

        $stmt = $this->connection->prepare($sql);

        try {
            $stmt->execute(['picture_id' => $pictureId]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (PDOException $ex) {
            throw new QueryExequtionFailException('Ошибка выполнения запроса.');
        }

        try {
            $numOfResultRows = count($result);
        }
        catch (TypeError $err) {
            throw new QueryExequtionFailException('Запрос вернул 0 значений.');
        }

        if ($numOfResultRows !== 0) {
            try {
                $user = new MysqlUser($this->connection);
                $user = $user->getById($result['user_id']);
            }
            catch (UserNotExistException $ex) {
                throw new CommentNotExistException($ex->getMessage());
            }

            $picture = new MysqlPicture($this->connection);

            try {
                $picture = $picture->getById($result['picture_id']);
            }
            catch (PictureNotExistException $ex) {
                throw new CommentNotExistException($ex->getMessage());
            }

            $commentList = [];

            foreach ($result as $row) {

                try {
                    $user = new MysqlUser($this->connection);
                    $user = $user->getById($row['user_id']);
                }
                catch (UserNotExistException $ex) {
                    throw new CommentNotExistException($ex->getMessage());
                }

                $picture = new MysqlPicture($this->connection);

                try {
                    $picture = $picture->getById($row['picture_id']);
                }
                catch (PictureNotExistException $ex) {
                    throw new CommentNotExistException($ex->getMessage());
                }

                $comment = new Comment(
                    $row['id'],
                    $user,
                    $picture, $row['comment_text'], $row['edited'],
                    new DateTime($row['creation_time']),
                    new DateTime($row['updatetime'])
                );

                array_push($commentlist, $comment);

                return $commentList;
            }
        }
        else {
            throw new CommentNotExistException();
        }
    }

    /**
     * @param Comment $newComment
     * @throws QueryExequtionFailException
     * @return void
     */
    public function create(Comment $newComment)
    {
        $sql = 'INSERT INTO `comments`( `id`, `user_id`, `picture_id`, `comment_text`, `edited`, `creation_time`, `update_time`)
                VALUES (:id, :user_id, :picture_id, :t_text, :edited, :creation_time, :update_time);';

        $stmt = $this->connection->prepare($sql);

        $values = [
            'id'            => $newComment->getID(),
            'user_id'       => $newComment->getUser()->getId(),
            'picture_id'    => $newComment->getPicture()->getID(),
            'comment_text'  => $newComment->getCommentText(),
            'edited'        => $newComment->isEdited(),
            'creation_time' => $newComment->getCreationTime(),
            'update_time'   => $newComment->getUpdateTime(),
        ];

        try {
            $stmt->execute($values);
        }
        catch (PDOException $ex) {
            throw new QueryExequtionFailException('Ошибка выполнения запроса.');
        }
    }

    /**
     * @param mixed $id
     * @throws QueryExequtionFailException
     * @return void
     */
    public function delete(string $id)
    {
        try {
            $comment = $this->getById($id);
            if (is_a($comment, 'Comment')) {
                $sql  = 'DELETE FROM `comments` WHERE `id` = :id;';
                $stmt = $this->connection->prepare($sql);
                try {
                    $stmt->execute(['id' => $id]);
                }
                catch (PDOException $ex) {
                    throw new QueryExequtionFailException();
                }
            }
        }
        catch (UserNotExistException $ex) {
            throw $ex;
        }
    }

    /**
     * @param mixed $id
     * @param mixed $newCommentText
     * @throws QueryExequtionFailException
     * @return void
     */
    public function update(string $id, string $newCommentText)
    {
        try {
            $comment = $this->getById($id);
            if (is_a($comment, 'Comment')) {

                $sql = 'UPDATE `comments` 
                        SET 
                        `comment_text` = :comment_text,
                        `edited` = true,
                        `update_time` = :update_time;';

                $stmt = $this->connection->prepare($sql);

                try {
                    $stmt->execute(['comment_text' => $newCommentText, 'update_time' => 'NOW()']);
                }
                catch (PDOException $ex) {
                    throw new QueryExequtionFailException();
                }
            }
        }
        catch (UserNotExistException $ex) {
            throw $ex;
        }
    }
}