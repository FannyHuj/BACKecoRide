<?php

namespace App\Entity;

use App\Repository\DriverPreferencesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DriverPreferencesRepository::class)]
class DriverPreferences
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?bool $animals = null;

    #[ORM\Column(nullable: true)]
    private ?bool $smoking = null;

    #[ORM\Column(type: Types::JSON, nullable: true)]
    private ?array $tags = null;

 

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isAnimals(): ?bool
    {
        return $this->animals;
    }

    public function setAnimals(?bool $animals): static
    {
        $this->animals = $animals;

        return $this;
    }

    public function isSmoking(): ?bool
    {
        return $this->smoking;
    }

    public function setSmoking(?bool $smoking): static
    {
        $this->smoking = $smoking;

        return $this;
    }

    public function getTags(): ?array
    {
        return $this->tags;
    }

    public function setTags(?array $tags): static
    {
        $this->tags = $tags;

        return $this;
    }
}
