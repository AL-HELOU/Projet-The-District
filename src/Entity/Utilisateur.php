<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
class Utilisateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $util_email = null;

    #[ORM\Column(length: 255)]
    private ?string $util_password = null;

    #[ORM\Column(length: 50)]
    private ?string $util_nom = null;

    #[ORM\Column(length: 50)]
    private ?string $util_prenom = null;

    #[ORM\Column(length: 20)]
    private ?string $util_telephone = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUtilEmail(): ?string
    {
        return $this->util_email;
    }

    public function setUtilEmail(string $util_email): self
    {
        $this->util_email = $util_email;

        return $this;
    }

    public function getUtilPassword(): ?string
    {
        return $this->util_password;
    }

    public function setUtilPassword(string $util_password): self
    {
        $this->util_password = $util_password;

        return $this;
    }

    public function getUtilNom(): ?string
    {
        return $this->util_nom;
    }

    public function setUtilNom(string $util_nom): self
    {
        $this->util_nom = $util_nom;

        return $this;
    }

    public function getUtilPrenom(): ?string
    {
        return $this->util_prenom;
    }

    public function setUtilPrenom(string $util_prenom): self
    {
        $this->util_prenom = $util_prenom;

        return $this;
    }

    public function getUtilTelephone(): ?string
    {
        return $this->util_telephone;
    }

    public function setUtilTelephone(string $util_telephone): self
    {
        $this->util_telephone = $util_telephone;

        return $this;
    }
}
