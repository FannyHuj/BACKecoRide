<?php

namespace App\dto;
use App\Entity\TripsStatusEnum;

Class TripFullDto {
    private ?\DateTimeInterface $departDate = null;
    private ?\DateTimeInterface $departHour = null;
    private ?string $departLocation = null;
    private ?\DateTimeInterface $arrivalDate = null;
    private ?\DateTimeInterface $arrivalHour = null;
    private ?string $arrivalLocation = null;
    private ?TripsStatusEnum $status =null;
    private ?int $placeNumber = null;
    private ?int $creditPrice = null;
    private ?int $carId;
    private ?int $userId;

    /**
     * Get the value of departDate
     */ 
    public function getDepartDate()
    {
        return $this->departDate;
    }

    /**
     * Set the value of departDate
     *
     * @return  self
     */ 
    public function setDepartDate($departDate)
    {
        $this->departDate = $departDate;

        return $this;
    }

    /**
     * Get the value of departHour
     */ 
    public function getDepartHour()
    {
        return $this->departHour;
    }

    /**
     * Set the value of departHour
     *
     * @return  self
     */ 
    public function setDepartHour($departHour)
    {
        $this->departHour = $departHour;

        return $this;
    }

    /**
     * Get the value of departLocation
     */ 
    public function getDepartLocation()
    {
        return $this->departLocation;
    }

    /**
     * Set the value of departLocation
     *
     * @return  self
     */ 
    public function setDepartLocation($departLocation)
    {
        $this->departLocation = $departLocation;

        return $this;
    }

    /**
     * Get the value of arrivalDate
     */ 
    public function getArrivalDate()
    {
        return $this->arrivalDate;
    }

    /**
     * Set the value of arrivalDate
     *
     * @return  self
     */ 
    public function setArrivalDate($arrivalDate)
    {
        $this->arrivalDate = $arrivalDate;

        return $this;
    }

    /**
     * Get the value of arrivalHour
     */ 
    public function getArrivalHour()
    {
        return $this->arrivalHour;
    }

    /**
     * Set the value of arrivalHour
     *
     * @return  self
     */ 
    public function setArrivalHour($arrivalHour)
    {
        $this->arrivalHour = $arrivalHour;

        return $this;
    }

    /**
     * Get the value of arrivalLocation
     */ 
    public function getArrivalLocation()
    {
        return $this->arrivalLocation;
    }

    /**
     * Set the value of arrivalLocation
     *
     * @return  self
     */ 
    public function setArrivalLocation($arrivalLocation)
    {
        $this->arrivalLocation = $arrivalLocation;

        return $this;
    }

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of placeNumber
     */ 
    public function getPlaceNumber()
    {
        return $this->placeNumber;
    }

    /**
     * Set the value of placeNumber
     *
     * @return  self
     */ 
    public function setPlaceNumber($placeNumber)
    {
        $this->placeNumber = $placeNumber;

        return $this;
    }

    /**
     * Get the value of creditPrice
     */ 
    public function getCreditPrice()
    {
        return $this->creditPrice;
    }

    /**
     * Set the value of creditPrice
     *
     * @return  self
     */ 
    public function setCreditPrice($creditPrice)
    {
        $this->creditPrice = $creditPrice;

        return $this;
    }

    /**
     * Get the value of carId
     */ 
    public function getCarId()
    {
        return $this->carId;
    }

    /**
     * Set the value of carId
     *
     * @return  self
     */ 
    public function setCarId($carId)
    {
        $this->carId = $carId;

        return $this;
    }

    /**
     * Get the value of usersId
     */ 
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set the value of usersId
     *
     * @return  self
     */ 
    public function setUsersId($userId)
    {
        $this->userId = $userId;

        return $this;
    }
}