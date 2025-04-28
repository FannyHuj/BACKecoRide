<?php

namespace App\dto;

Class StatisticDto {

    private ?int $totalUser = null;
    private ?int $totalCredit = null;
    private ?array $tripsPerDay = null;
    private ?int $creditsPerDay = null;
    private ?array $day=null;


    /**
     * Get the value of totalUser
     */ 
    public function getTotalUser()
    {
        return $this->totalUser;
    }

    /**
     * Set the value of totalUser
     *
     * @return  self
     */ 
    public function setTotalUser($totalUser)
    {
        $this->totalUser = $totalUser;

        return $this;
    }

    /**
     * Get the value of totalCredit
     */ 
    public function getTotalCredit()
    {
        return $this->totalCredit;
    }

    /**
     * Set the value of totalCredit
     *
     * @return  self
     */ 
    public function setTotalCredit($totalCredit)
    {
        $this->totalCredit = $totalCredit;

        return $this;
    }

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