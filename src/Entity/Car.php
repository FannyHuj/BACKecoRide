<?php

namespace App\Entity;

use App\Repository\CarRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarRepository::class)]
class Car
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $model = null;

    #[ORM\Column(length: 50)]
    private ?string $registration = null;

    #[ORM\Column(length: 50, enumType:EnergyEnum::class)]
    private ?EnergyEnum $energy = null;

    #[ORM\Column(length: 50)]
    private ?string $color = null;

    #[ORM\Column (type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $firstRegistrationDate = null;
    
    #[ORM\Column(length: 50)]
    private ?string $brand;

    #[ORM\ManyToOne(inversedBy: 'cars')]
    private ?User $user = null;

    public function getBrand()  
    {
        return $this->brand;
    }   

    public function setBrand($brand): void
    {
        $this->brand = $brand;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): static
    {
        $this->model = $model;

        return $this;
    }

    public function getRegistration(): ?string
    {
        return $this->registration;
    }

    public function setRegistration(string $registration): static
    {
        $this->registration = $registration;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): static
    {
        $this->color = $color;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

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
}
