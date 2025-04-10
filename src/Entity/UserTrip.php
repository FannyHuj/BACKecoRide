<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;
use App\Entity\Trip;

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

    public function isDriver(): ?bool
    {
        return $this->driver;
    }

    public function setDriver(bool $role): static
    {
        $this->driver = $role;

        return $this;
    }

}