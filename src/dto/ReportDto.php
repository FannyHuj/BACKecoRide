<?php

namespace App\dto;

Class ReportDto {

    private ?TripFullDto $idTrip = null;
    private ?\DateTimeInterface $date = null;
    private ?string $detail = null;
    private ?UserDtoMin $reportOwner = null;
    private ?int $id = null;


    /**
     * Get the value of idTrip
     */ 
    public function getIdTrip()
    {
        return $this->idTrip;
    }

    /**
     * Set the value of idTrip
     *
     * @return  self
     */ 
    public function setIdTrip($idTrip)
    {
        $this->idTrip = $idTrip;

        return $this;
    }

    
    /**
     * Get the value of date
     */ 
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */ 
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get the value of detail
     */ 
    public function getDetail()
    {
        return $this->detail;
    }

    /**
     * Set the value of detail
     *
     * @return  self
     */ 
    public function setDetail($detail)
    {
        $this->detail = $detail;

        return $this;
    }

    /**
     * Get the value of reportOwner
     */ 
    public function getReportOwner()
    {
        return $this->reportOwner;
    }

    /**
     * Set the value of reportOwner
     *
     * @return  self
     */ 
    public function setReportOwner($reportOwner)
    {
        $this->reportOwner = $reportOwner;

        return $this;
    }

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
}