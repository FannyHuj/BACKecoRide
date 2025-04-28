<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;
use App\Entity\Trip;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity]
class UserTrip
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity : User::class, inversedBy :'trips')]
    private ?User $user = null;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity:Trip::class, inversedBy:'users')]
    private ?Trip $trip = null;


    #[ORM\Column]
    private ?bool $driver=null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $bookingDate = null;


   public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getTrip(): ?Trip
    {
        return $this->trip;
    }

    public function setTrip(Trip $trip): static
    {
        $this->trip = $trip;

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

    /**
     * Get the value of bookingDate
     */ 
    public function getBookingDate()
    {
        return $this->bookingDate;
    }

    /**
     * Set the value of bookingDate
     *
     * @return  self
     */ 
    public function setBookingDate($bookingDate)
    {
        $this->bookingDate = $bookingDate;

        return $this;
    }
}