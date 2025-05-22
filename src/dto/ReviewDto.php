<?php

namespace App\dto;


Class ReviewDto {
    private ?int $id = null;
    private ?string $comment = null;
    private ?string $notation = null;
    private ?bool $publish = null;
    private ?UserDtoMin $ownerId = null;
    private ?int $tripId = null;


    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of comment
     */ 
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set the value of comment
     *
     * @return  self
     */ 
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get the value of notation
     */ 
    public function getNotation()
    {
        return $this->notation;
    }

    /**
     * Set the value of notation
     *
     * @return  self
     */ 
    public function setNotation($notation)
    {
        $this->notation = $notation;

        return $this;
    }

    /**
     * Get the value of publish
     */ 
    public function getPublish()
    {
        return $this->publish;
    }

    /**
     * Set the value of publish
     *
     * @return  self
     */ 
    public function setPublish($publish)
    {
        $this->publish = $publish;

        return $this;
    }

   

    /**
     * Get the value of ownerId
     */ 
    public function getOwnerId()
    {
        return $this->ownerId;
    }

    /**
     * Set the value of ownerId
     *
     * @return  self
     */ 
    public function setOwnerId($ownerId)
    {
        $this->ownerId = $ownerId;

        return $this;
    }

    /**
     * Get the value of tripId
     */ 
    public function getTripId()
    {
        return $this->tripId;
    }

    /**
     * Set the value of tripId
     *
     * @return  self
     */ 
    public function setTripId($tripId)
    {
        $this->tripId = $tripId;

        return $this;
    }
}