<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
    #[Assert\PositiveOrZero]
    private ?int $com_etat = null;

    #[ORM\OneToMany(mappedBy: 'det_commande', targetEntity: Detail::class, orphanRemoval:true)]
    private Collection $com_details;

    #[ORM\ManyToOne(inversedBy: 'util_commandes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $com_utilisateur = null;

    public function __construct()
    {
        $this->com_details = new ArrayCollection();
        $this->com_datecommande = new \DateTimeImmutable();
    }

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

    /**
     * @return Collection<int, Detail>
     */
    public function getComDetails(): Collection
    {
        return $this->com_details;
    }

    public function addComDetail(Detail $comDetail): self
    {
        if (!$this->com_details->contains($comDetail)) {
            $this->com_details->add($comDetail);
            $comDetail->setDetCommande($this);
        }

        return $this;
    }

    public function removeComDetail(Detail $comDetail): self
    {
        if ($this->com_details->removeElement($comDetail)) {
            // set the owning side to null (unless already changed)
            if ($comDetail->getDetCommande() === $this) {
                $comDetail->setDetCommande(null);
            }
        }

        return $this;
    }

    public function getComUtilisateur(): ?Utilisateur
    {
        return $this->com_utilisateur;
    }

    public function setComUtilisateur(?Utilisateur $com_utilisateur): self
    {
        $this->com_utilisateur = $com_utilisateur;

        return $this;
    }
}
