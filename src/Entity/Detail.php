<?php

namespace App\Entity;

use App\Repository\DetailRepository;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: DetailRepository::class)]
class Detail
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Assert\NotNull]
    #[Assert\Positive]
    private ?int $det_quantite = null;

    #[ORM\ManyToOne(inversedBy: 'plat_details', targetEntity: Plat::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Plat $det_plat = null;

    #[ORM\ManyToOne(inversedBy: 'com_details')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Commande $det_commande = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDetQuantite(): ?int
    {
        return $this->det_quantite;
    }

    public function setDetQuantite(int $det_quantite): self
    {
        $this->det_quantite = $det_quantite;

        return $this;
    }

    public function getDetPlat(): ?Plat
    {
        return $this->det_plat;
    }

    public function setDetPlat(?Plat $det_plat): self
    {
        $this->det_plat = $det_plat;

        return $this;
    }

    public function getDetCommande(): ?Commande
    {
        return $this->det_commande;
    }

    public function setDetCommande(?Commande $det_commande): self
    {
        $this->det_commande = $det_commande;

        return $this;
    }
}
