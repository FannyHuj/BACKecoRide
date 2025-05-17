<?php

namespace App\dto;

use App\Entity\EnergyEnum;
use DateTime;

Class CarDto {

    private ?int $id = null;
    private ?string $model = null;
    private ?string $registration = null;
    private ?EnergyEnum $energy = null;
    private ?string $color = null;
    private ?DateTime $firstRegistrationDate = null;
    private ?string $brand = null;
    private ?UserDtoMin $driver = null;


    /**
     * Get the value of model
     */ 
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set the value of model
     *
     * @return  self
     */ 
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get the value of registration
     */ 
    public function getRegistration()
    {
        return $this->registration;
    }

    /**
     * Set the value of registration
     *
     * @return  self
     */ 
    public function setRegistration($registration)
    {
        $this->registration = $registration;

        return $this;
    }

    /**
     * Get the value of energy
     */ 
    public function getEnergy()
    {
        return $this->energy;
    }

    /**
     * Set the value of energy
     *
     * @return  self
     */ 
    public function setEnergy($energy)
    {
        $this->energy = $energy;

        return $this;
    }

    /**
     * Get the value of color
     */ 
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set the value of color
     *
     * @return  self
     */ 
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get the value of brand
     */ 
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set the value of brand
     *
     * @return  self
     */ 
    public function setBrand($brand)
    {
        $this->brand = $brand;

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


    /**
     * Get the value of firstRegistrationDate
     */ 
    public function getFirstRegistrationDate()
    {
        return $this->firstRegistrationDate;
    }

    /**
     * Set the value of firstRegistrationDate
     *
     * @return  self
     */ 
    public function setFirstRegistrationDate($firstRegistrationDate)
    {
        $this->firstRegistrationDate = $firstRegistrationDate;

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
}