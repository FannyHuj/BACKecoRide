<?php

namespace App\Entity;

use App\Repository\TripRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TripRepository::class)]
class Trip
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $departDate = null;

    #[ORM\Column(length: 50)]
    private ?string $departLocation = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $arrivalDate = null;

    #[ORM\Column(length: 50)]
    private ?string $arrivalLocation = null;

    #[ORM\Column(type: 'string', enumType: TripsStatusEnum::class)]
    private ?TripsStatusEnum $status = null;

    #[ORM\Column]
    private ?int $placeNumber = null;

    #[ORM\Column]
    private ?int $creditPrice = null;

    #[ORM\ManyToOne(targetEntity: Car::class)]
    private ?Car $car;


    #[ORM\OneToMany(targetEntity: UserTrip::class, cascade: ['persist'], mappedBy:'trip')]
    private Collection $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getDepartDate(): ?\DateTimeInterface
    {
        return $this->departDate;
    }

    public function setDepartDate(?\DateTimeInterface $departDate): void
    {
        $this->departDate = $departDate;
    }

    public function getDepartLocation(): ?string
    {
        return $this->departLocation;
    }

    public function setDepartLocation(?string $departLocation): void
    {
        $this->departLocation = $departLocation;
    }

    public function getArrivalDate(): ?\DateTimeInterface
    {
        return $this->arrivalDate;
    }

    public function setArrivalDate(?\DateTimeInterface $arrivalDate): void
    {
        $this->arrivalDate = $arrivalDate;
    }
    
    public function getArrivalLocation(): ?string
    {
        return $this->arrivalLocation;
    }

    public function setArrivalLocation(?string $arrivalLocation): void
    {
        $this->arrivalLocation = $arrivalLocation;
    }

    public function getStatus(): ?TripsStatusEnum
    {
        return $this->status;
    }

    public function setStatus(?TripsStatusEnum $status): void
    {
        $this->status = $status;
    }

    public function getPlaceNumber(): ?int
    {
        return $this->placeNumber;
    }

    public function setPlaceNumber(?int $placeNumber): void
    {
        $this->placeNumber = $placeNumber;
    }

    public function getcreditPrice(): ?int
    {
        return $this->creditPrice;
    }

    public function setcreditPrice(?int $creditPrice): void
    {
        $this->creditPrice = $creditPrice;
    }

    public function getCar(): ?Car
    {
        return $this->car;
    }

    public function setCar(?Car $car): void
    {
        $this->car = $car;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(UserTrip $userTrip): self
    {
            if (!$this->users->contains($userTrip)) {
                $this->users->add($userTrip);
                $userTrip->setTrip($this); // Maintient la cohérence de la relation bidirectionnelle
            }

            return $this;
    }

    public function removeUsers(User $users): static
    {
        $this->users->removeElement($users);

        return $this;
    }
}
