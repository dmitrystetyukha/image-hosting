<?php

namespace app\db\repository\mysql;

use app\db\model\Picture;
use app\db\repository\base\BasePicture;
use app\db\repository\PictureAlreadyExistException;
use app\db\repository\PictureNotExistException;
use app\db\repository\QueryExequtionFailException;
use app\db\repository\UserNotExistException;
use DateTime;
use PDO;
use PDOException;
use TypeError;

class MysqlPicture extends BasePicture
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param mixed $id
     * @return Picture
     * @throws UserNotExistException
     * @throws QueryExequtionFailException|QueryExequtionFailException
     */
    public function getById(string $id): Picture
    {
        $sql = 'SELECT * FROM `pictures` WHERE `id`=:id;';

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
                throw $ex;
            }

            return new Picture($result['id'], $user, $result['file_path'], $result['name'], $result['description'], $result['num_of_views'], $result['md5_hash'], new DateTime($result['upload_time']), $result['num_of_comments']);
        }
        else {
            throw new UserNotExistException();
        }
    }


    /**
     * @param string $mdHash
     * @return Picture
     * @throws QueryExequtionFailException
     * @throws UserNotExistException|PictureNotExistException
     */
    public function getByHash(string $mdHash): Picture
    {
        $sql = 'SELECT * FROM `pictures` WHERE `md5_hash`=:hash;';

        $stmt = $this->connection->prepare($sql);

        try {
            $stmt->execute(['hash' => $mdHash]);
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
            $user = new MysqlUser($this->connection);

            try {
                $user = $user->getById($result['user_id']);
            }
            catch (UserNotExistException $ex) {
                throw new PictureNotExistException($ex->getMessage());
            }
            return new Picture(
                $result['id'],
                $user, $result['file_path'], $result['name'], $result['description'], $result['num_of_views'], $result['md5_hash'],
                new DateTime($result['upload_time']), $result['num_of_comments']
            );
        }
        else {
            throw new PictureNotExistException();
        }
    }

    /**
     * @return array
     */
    public function getAllPictures(): array
    {
        $pictureList = [];

        $sql  = 'SELECT * FROM `pictures`';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll();

        foreach ($result as $row) {
            $user = new MysqlUser($this->connection);
            try {
                $user = $user->getById($row['user_id']);
            }
            catch (UserNotExistException $ex) {
                throw new PictureNotExistException($ex->getMessage());
            }

            $picture = new Picture(
                $row['id'],
                $user, $row['file_path'],
                $row['name'], $row['description'], $row['num_of_view'],
                $row['md5_hash'], $row['upload_time'], $row['num_of_comments']
            );
            array_push($pictureList, $picture);
        }

        return $pictureList;
    }


    /**
     * @param Picture $newPicture
     * @return void
     * @throws QueryExequtionFailException|PictureAlreadyExistException|UserNotExistException
     */
    public function create(Picture $newPicture)
    {
        try {

            $this->getByHash($newPicture->getMdHash());

        }
        catch (PictureNotExistException $ex) {

            $sql = 'INSERT INTO `pictures`( `id`, `user_id`, `file_path`, `name`, `description`, `num_of_views`, `md5_hash`, `upload_time`, `num_of_comment`)
                VALUES (:id, :user_id, :file_path, :name, :description, :num_of_views, :md5_hash, :upload_time, :num_of_comment);';

            $stmt = $this->connection->prepare($sql);

            $values = [
                'id'             => $newPicture->getID(),
                'user_id'        => $newPicture->getUser()->getId(),
                'file_path'      => $newPicture->getFilePath(),
                'name'           => $newPicture->getName(),
                'description'    => $newPicture->getDescription(),
                'num_of_views'   => $newPicture->getNumOfViews(),
                'md5_hash'       => $newPicture->getMdHash(),
                'upload_time'    => $newPicture->getUploadTime(),
                'num_of_comment' => $newPicture->getNumOfComments()
            ];

            try {
                $stmt->execute($values);
            }
            catch (PDOException $ex) {
                throw new QueryExequtionFailException('Ошибка выполнения запроса.');
            }

        }
    }
}