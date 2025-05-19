<?php

namespace App\dto;

use App\Entity\EnergyEnum;

Class CarMinDto {
    
    private ?int $id = null;
    private ?string $model = null;
    private ?EnergyEnum $energy = null;
    private ?string $color = null;
     private ?string $brand = null;

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
}
