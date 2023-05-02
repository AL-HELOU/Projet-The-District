<?php

namespace App\Entity;

use App\Repository\DetailRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DetailRepository::class)]
class Detail
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $det_quantite = null;

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
}
