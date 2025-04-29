<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?float $string = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getString(): ?float
    {
        return $this->string;
    }

    public function setString(?float $string): static
    {
        $this->string = $string;

        return $this;
    }
}
