<?php

namespace App\Entity;

use App\Repository\RentalRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RentalRepository::class)]
class Rental
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Client $client = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $rentFrom = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $rentTo = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): static
    {
        $this->client = $client;

        return $this;
    }

    public function getRentFrom(): ?\DateTime
    {
        return $this->rentFrom;
    }

    public function setRentFrom(\DateTime $rentFrom): static
    {
        $this->rentFrom = $rentFrom;

        return $this;
    }

    public function getRentTo(): ?\DateTime
    {
        return $this->rentTo;
    }

    public function setRentTo(\DateTime $rentTo): static
    {
        $this->rentTo = $rentTo;

        return $this;
    }
}
