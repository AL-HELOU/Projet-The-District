<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    #[Assert\NotNull]
    #[Assert\Positive]
    private ?string $com_total = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotNull]
    #[Assert\Date]
    private ?\DateTimeInterface $com_datecommande = null;

    #[ORM\Column]
    #[Assert\NotNull]
    private ?int $com_etat = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getComTotal(): ?string
    {
        return $this->com_total;
    }

    public function setComTotal(string $com_total): self
    {
        $this->com_total = $com_total;

        return $this;
    }

    public function getComDatecommande(): ?\DateTimeInterface
    {
        return $this->com_datecommande;
    }

    public function setComDatecommande(\DateTimeInterface $com_datecommande): self
    {
        $this->com_datecommande = $com_datecommande;

        return $this;
    }

    public function getComEtat(): ?int
    {
        return $this->com_etat;
    }

    public function setComEtat(int $com_etat): self
    {
        $this->com_etat = $com_etat;

        return $this;
    }
}
