<?php

namespace App\dto;

Class SearchDto {

    private ?\DateTimeInterface $departDate = null;
    private ?string $departLocation = null;
    private ?string $arrivalLocation = null;
    private ?int $placeNumber = null;

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
}