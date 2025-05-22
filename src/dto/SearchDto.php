<?php

namespace App\dto;

Class SearchDto {

    private ?\DateTimeInterface $departDate = null;
    private ?string $departLocation = null;
    private ?string $arrivalLocation = null;
    private ?int $placeNumber = null;
    private ?int $creditPrice = null;
    private ?int $notation = null;
    private ?bool $isEcologic= null;

    //constructeur SANS PARAMETRES avec valeur par défaut
    public function __construct()
    {
        $this->departDate = new \DateTime();
        $this->departLocation = '';
        $this->arrivalLocation = '';
        $this->placeNumber = 0;
        $this->creditPrice = 0;
        $this->notation = 0;
        $this->isEcologic = false;
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
     * Get the value of isEcologic
     */ 
    public function getIsEcologic()
    {
        return $this->isEcologic;
    }

    /**
     * Set the value of isEcologic
     *
     * @return  self
     */ 
    public function setIsEcologic($isEcologic)
    {
        $this->isEcologic = $isEcologic;

        return $this;
    }
}