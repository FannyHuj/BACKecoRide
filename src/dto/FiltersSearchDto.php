<?php

namespace App\dto;

Class FiltersSearchDto {

    private ?int $duration = null;
    private ?int $maxPrice = null;
    private ?int $rating = null;
    private ?bool $electricCar = null;


    /**
     * Get the value of duration
     */ 
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set the value of duration
     *
     * @return  self
     */ 
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get the value of maxPrice
     */ 
    public function getMaxPrice()
    {
        return $this->maxPrice;
    }

    /**
     * Set the value of maxPrice
     *
     * @return  self
     */ 
    public function setMaxPrice($maxPrice)
    {
        $this->maxPrice = $maxPrice;

        return $this;
    }

    /**
     * Get the value of rating
     */ 
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set the value of rating
     *
     * @return  self
     */ 
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get the value of electricCar
     */ 
    public function getElectricCar()
    {
        return $this->electricCar;
    }

    /**
     * Set the value of electricCar
     *
     * @return  self
     */ 
    public function setElectricCar($electricCar)
    {
        $this->electricCar = $electricCar;

        return $this;
    }
}