<?php

namespace App\dto;

Class StatisticDto {


    private ?array $tripsPerDay = null;
    private ?int $creditsPerDay = null;
    private ?array $day=null;

    /**
     * Get the value of creditsPerDay
     */ 
    public function getCreditsPerDay()
    {
        return $this->creditsPerDay;
    }

    /**
     * Set the value of creditsPerDay
     *
     * @return  self
     */ 
    public function setCreditsPerDay($creditsPerDay)
    {
        $this->creditsPerDay = $creditsPerDay;

        return $this;
    }


    /**
     * Get the value of day
     */ 
    public function getDay()
    {
        return $this->day;
    }

    /**
     * Set the value of day
     *
     * @return  self
     */ 
    public function setDay($day)
    {
        $this->day = $day;

        return $this;
    }

    /**
     * Get the value of tripsPerDay
     */ 
    public function getTripsPerDay()
    {
        return $this->tripsPerDay;
    }

    /**
     * Set the value of tripsPerDay
     *
     * @return  self
     */ 
    public function setTripsPerDay($tripsPerDay)
    {
        $this->tripsPerDay = $tripsPerDay;

        return $this;
    }
}