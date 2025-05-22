<?php

namespace App\Entity;

use App\Repository\ReportTripRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReportTripRepository::class)]
class ReportTrip
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Trip $trip = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $detail = null;

    #[ORM\ManyToOne]
    private ?User $reportOwner = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?bool $publish = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTrip(): ?Trip
    {
        return $this->trip;
    }

    public function setTrip(?Trip $trip): static
    {
        $this->trip = $trip;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getDetail(): ?string
    {
        return $this->detail;
    }

    public function setDetail(?string $detail): static
    {
        $this->detail = $detail;

        return $this;
    }

    public function getReportOwner(): ?User
    {
        return $this->reportOwner;
    }

    public function setReportOwner(?User $reportOwner): static
    {
        $this->reportOwner = $reportOwner;

        return $this;
    }

    /**
     * Get the value of publish
     */ 
    public function getPublish()
    {
        return $this->publish;
    }

    /**
     * Set the value of publish
     *
     * @return  self
     */ 
    public function setPublish($publish)
    {
        $this->publish = $publish;

        return $this;
    }
}
