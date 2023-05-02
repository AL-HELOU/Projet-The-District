<?php

namespace App\Entity;

use App\Repository\PlatRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlatRepository::class)]
class Plat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $plat_libelle = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $plat_description = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 6, scale: 2)]
    private ?string $plat_prix = null;

    #[ORM\Column(length: 255)]
    private ?string $plat_image = null;

    #[ORM\Column]
    private ?bool $plat_active = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlatLibelle(): ?string
    {
        return $this->plat_libelle;
    }

    public function setPlatLibelle(string $plat_libelle): self
    {
        $this->plat_libelle = $plat_libelle;

        return $this;
    }

    public function getPlatDescription(): ?string
    {
        return $this->plat_description;
    }

    public function setPlatDescription(string $plat_description): self
    {
        $this->plat_description = $plat_description;

        return $this;
    }

    public function getPlatPrix(): ?string
    {
        return $this->plat_prix;
    }

    public function setPlatPrix(string $plat_prix): self
    {
        $this->plat_prix = $plat_prix;

        return $this;
    }

    public function getPlatImage(): ?string
    {
        return $this->plat_image;
    }

    public function setPlatImage(string $plat_image): self
    {
        $this->plat_image = $plat_image;

        return $this;
    }

    public function isPlatActive(): ?bool
    {
        return $this->plat_active;
    }

    public function setPlatActive(bool $plat_active): self
    {
        $this->plat_active = $plat_active;

        return $this;
    }
}
