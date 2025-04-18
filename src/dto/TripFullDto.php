<?php

namespace App\dto;
use App\Entity\TripsStatusEnum;

Class TripFullDto {
    private ?int $id = null;
    private ?\DateTimeInterface $departDate = null;
    private ?\DateTimeInterface $departHour = null;
    private ?string $departLocation = null;
    private ?\DateTimeInterface $arrivalDate = null;
    private ?\DateTimeInterface $arrivalHour = null;
    private ?string $arrivalLocation = null;
    private ?TripsStatusEnum $status =null;
    private ?int $placeNumber = null;
    private ?int $creditPrice = null;
    private ?CarMinDto $car;
    private ?UserDtoMin $driver;

    
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
     * Get the value of driver
     */ 
    public function getDriver()
    {
        return $this->driver;
    }

    /**
     * Set the value of driver
     *
     * @return  self
     */ 
    public function setDriver($driver)
    {
        $this->driver = $driver;

        return $this;
    }

    /**
     * Get the value of car
     */ 
    public function getCar()
    {
        return $this->car;
    }

    /**
     * Set the value of car
     *
     * @return  self
     */ 
    public function setCar($car)
    {
        $this->car = $car;

        return $this;
    }
}