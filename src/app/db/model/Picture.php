<?php
namespace app\db\model;

use DateTime;

use app\utils\UUID;

class Picture
{
    private string $id;
    private User $user;
    private string $filePath;
    private ?string $name;
    private string $description;
    private int $numOfViews;
    private string $mdHash;
    private DateTime $uploadTime;
    private int $numOfComments;

    public function __construct(
        ?string $id, User $user, string $filePath, string $name, string $description, int $numOfViews, string $mdHash, DateTime $uploadTime, int $numOfComments
    ) {
        $this->id            = (is_null($id)) ? UUID::v4() : $id;
        $this->user          = $user;
        $this->filePath      = $filePath;
        $this->name          = $name;
        $this->description   = $description;
        $this->numOfViews    = $numOfViews;
        $this->mdHash        = $mdHash;
        $this->uploadTime    = $uploadTime;
        $this->numOfComments = $numOfComments;

    }

    /**
     * @return string
     */
    public function getID(): string
    {
        return $this->id;
    }

    /**
     * @return User 
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @return string
     */
    public function getFilePath(): string
    {
        return $this->filePath;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return int
     */
    public function getNumOfViews(): int
    {
        return $this->numOfViews;
    }

    /**
     * @return string
     */
    public function getMdHash(): string
    {
        return $this->mdHash;
    }

    /**
     * @return DateTime
     */
    public function getUploadTime(): DateTime
    {
        return $this->uploadTime;
    }


    /**
     * @return int
     */
    public function getNumOfComments(): int
    {
        return $this->numOfComments;
    }
}