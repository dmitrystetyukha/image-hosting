<?php

namespace app\models;

use DateTime;

class Comment
{

    private string $id;
    private User $user;
    private Picture $picture;
    private string $commentText;
    private bool $edited;
    private DateTime $creationTime;
    private DateTime $updateTime;

    public function __construct($id, User $user, Picture $picture, $commentText, $edited, DateTime $creationTime, DateTime $updateTime)
    {
        $this->id           = $id;
        $this->user         = $user;
        $this->picture      = $picture;
        $this->commentText  = $commentText;
        $this->edited       = $edited;
        $this->creationTime = $creationTime;
        $this->updateTime   = $updateTime;
    }

    /**
     * @return string
     */
    public function getId(): string
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
     * @return Picture
     */
    public function getPicture(): Picture
    {
        return $this->picture;
    }

    /**
     * @return string
     */
    public function getCommentText(): string
    {
        return $this->commentText;
    }

    /**
     * @return bool
     */
    public function isEdited(): bool
    {
        return $this->edited;
    }

    /**
     * @return DateTime
     */
    public function getCreationTime(): DateTime
    {
        return $this->creationTime;
    }

    /**
     * @return DateTime
     */
    public function getUpdateTime(): DateTime
    {
        return $this->updateTime;
    }
}