<?php

namespace app\models;

use DateTime;

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
        string $id, User $user, string $filePath, ?string $header, string $description,
        int $views, string $mdHash, DateTime $uploadTime, int $commentCount
    )
    {
        $this->id            = $id;
        $this->user          = $user;
        $this->filePath      = $filePath;
        $this->name          = $header;
        $this->description   = $description;
        $this->numOfViews    = $views;
        $this->mdHash        = $mdHash;
        $this->uploadTime    = $uploadTime;
        $this->numOfComments = $commentCount;
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