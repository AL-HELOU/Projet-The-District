<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PlatRepository;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


#[ORM\Entity(repositoryClass: PlatRepository::class)]
#[UniqueEntity('plat_libelle')]

class Plat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank]
    #[Assert\NotNull]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'The plate label must be at least {{ 2 }} characters long',
        maxMessage: 'The plate label cannot be longer than {{ 50 }} characters',
    )]
    private ?string $plat_libelle = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank]
    #[Assert\NotNull]
    private ?string $plat_description = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 6, scale: 2)]
    #[Assert\NotNull]
    #[Assert\Positive]
    private ?string $plat_prix = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank]
    #[Assert\NotNull]
    private ?string $plat_image = null;

    #[ORM\Column]
    #[Assert\NotNull]
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
