<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
#[UniqueEntity('cat_libelle')]
class Categorie
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
        minMessage: 'The category label must be at least {{ 2 }} characters long',
        maxMessage: 'The  category label cannot be longer than {{ 50 }} characters',
    )]
    private ?string $cat_libelle = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank]
    #[Assert\NotNull]
    private ?string $cat_image = null;

    #[ORM\Column]
    #[Assert\NotNull]
    private ?bool $cat_active = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCatLibelle(): ?string
    {
        return $this->cat_libelle;
    }

    public function setCatLibelle(string $cat_libelle): self
    {
        $this->cat_libelle = $cat_libelle;

        return $this;
    }

    public function getCatImage(): ?string
    {
        return $this->cat_image;
    }

    public function setCatImage(string $cat_image): self
    {
        $this->cat_image = $cat_image;

        return $this;
    }

    public function isCatActive(): ?bool
    {
        return $this->cat_active;
    }

    public function setCatActive(bool $cat_active): self
    {
        $this->cat_active = $cat_active;

        return $this;
    }
}
