<?php

namespace App\Entity;

use App\Repository\BrandRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections;
#[ORM\Entity(repositoryClass: BrandRepository::class)]
class Brand
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $libelle = null;

    #[ORM\OneToMany(targetEntity: Car::class)]
    private Collection $brand;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBrand(): Collection
    {
        return $this->brand;
    }

    public function setBrand(Collection $brand): void
    {
        $this->brand = $brand;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }
}
