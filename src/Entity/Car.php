<?php

namespace App\Entity;

use App\Repository\CarRepository;
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

    #[ORM\Column(length: 50)]
    private ?string $energy = null;

    #[ORM\Column(length: 50)]
    private ?string $color = null;

    #[ORM\Column(length: 50)]
    private ?string $firstRegistrationDate = null;

    #[ORM\OneToOne(targetEntity: Brand::class)]
    private Collection $car;

    public function getCars(): Collection
    {
        return $this->cars;
    }

    public function setCars(Collection $cars): void
    {
        $this->cars = $cars;
    }

    public function getCar(): Collection
    {
        return $this->car;
    }

    public function setCar(Collection $car): void
    {
        $this->car = $car;
    }

    #[ORM\OneToOne(targetEntity: User::class)]
    private Collection $cars;
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

    public function getEnergy(): ?string
    {
        return $this->energy;
    }

    public function setEnergy(string $energy): static
    {
        $this->energy = $energy;

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

    public function getFirstRegistrationDate(): ?string
    {
        return $this->firstRegistrationDate;
    }

    public function setFirstRegistrationDate(string $firstRegistrationDate): static
    {
        $this->firstRegistrationDate = $firstRegistrationDate;

        return $this;
    }
}
