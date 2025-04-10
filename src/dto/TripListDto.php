<?php

namespace App\dto;

Class TripListDto {
    private ?\DateTimeInterface $departDate =null;
    private ?\DateTimeInterface $departHour = null;
    private ?\DateTimeInterface $arrivalHour = null;
    private ?string $driverFirstName = null;
    private ?int $notation = null; 
    private ?int $creditPrice = null;


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
     * Get the value of driverFirstName
     */ 
    public function getDriverFirstName()
    {
        return $this->driverFirstName;
    }

    /**
     * Set the value of driverFirstName
     *
     * @return  self
     */ 
    public function setDriverFirstName($driverFirstName)
    {
        $this->driverFirstName = $driverFirstName;

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
} 