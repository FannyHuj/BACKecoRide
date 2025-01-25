<?php

namespace App\Entity;

use App\Repository\TripRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Collection;

#[ORM\Entity(repositoryClass: TripRepository::class)]
class Trip
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $departDate = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $departHour = null;

    #[ORM\Column(length: 50)]
    private ?string $departLocation = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $arrivalDate = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $arrivalHour = null;

    #[ORM\Column(length: 50)]
    private ?string $arrivalLocation = null;

    #[ORM\Column(length: 50)]
    private ?string $status = null;

    #[ORM\Column]
    private ?int $placeNumber = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column(length: 255)]
    private ?string $person = null;

    #[ORM\ManyToMany(targetEntity: Trip::class, inversedBy: 'trips')]
    private Collection $users;

    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function setUsers(Collection $users): void
    {
        $this->users = $users;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDepartDate(): ?\DateTimeInterface
    {
        return $this->departDate;
    }

    public function setDepartDate(\DateTimeInterface $departDate): static
    {
        $this->departDate = $departDate;

        return $this;
    }

    public function getDepartHour(): ?\DateTimeInterface
    {
        return $this->departHour;
    }

    public function setDepartHour(\DateTimeInterface $departHour): static
    {
        $this->departHour = $departHour;

        return $this;
    }

    public function getDepartLocation(): ?string
    {
        return $this->departLocation;
    }

    public function setDepartLocation(string $departLocation): static
    {
        $this->departLocation = $departLocation;

        return $this;
    }

    public function getArrivalDate(): ?\DateTimeInterface
    {
        return $this->arrivalDate;
    }

    public function setArrivalDate(\DateTimeInterface $arrivalDate): static
    {
        $this->arrivalDate = $arrivalDate;

        return $this;
    }

    public function getArrivalHour(): ?\DateTimeInterface
    {
        return $this->arrivalHour;
    }

    public function setArrivalHour(\DateTimeInterface $arrivalHour): static
    {
        $this->arrivalHour = $arrivalHour;

        return $this;
    }

    public function getArrivalLocation(): ?string
    {
        return $this->arrivalLocation;
    }

    public function setArrivalLocation(string $arrivalLocation): static
    {
        $this->arrivalLocation = $arrivalLocation;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getPlaceNumber(): ?int
    {
        return $this->placeNumber;
    }

    public function setPlaceNumber(int $placeNumber): static
    {
        $this->placeNumber = $placeNumber;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getPerson(): ?string
    {
        return $this->person;
    }

    public function setPerson(string $person): static
    {
        $this->person = $person;

        return $this;
    }
}
