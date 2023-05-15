<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UtilisateurRepository;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
#[ORM\EntityListeners(['App\EntityListener\UtilisateurListener'])]
#[UniqueEntity('util_email')]
#[UniqueEntity('util_telephone')]

class Utilisateur implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column(length: 50)]
    #[Assert\NotBlank]
    #[Assert\NotNull]
    #[Assert\Email(
        message: 'The email {{ value }} is not a valid email.',
    )]
    private ?string $util_email = null;


    private ?string $plainPassword = null;


    #[ORM\Column(length: 255)]
    private ?string $password = null;


    #[ORM\Column(length: 50)]
    #[Assert\NotBlank]
    #[Assert\NotNull]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'The user name must be at least {{ 2 }} characters long',
        maxMessage: 'The user name cannot be longer than {{ 50 }} characters',
    )]
    private ?string $util_nom = null;


    #[ORM\Column(length: 50)]
    #[Assert\NotBlank]
    #[Assert\NotNull]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'The user firstname must be at least {{ 2 }} characters long',
        maxMessage: 'The user firstname cannot be longer than {{ 50 }} characters',
    )]
    private ?string $util_prenom = null;


    #[ORM\Column(length: 20)]
    #[Assert\NotBlank]
    #[Assert\NotNull]
    private ?string $util_telephone = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank]
    #[Assert\NotNull]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'The address must be at least {{ 2 }} characters long',
        maxMessage: 'The address cannot be longer than {{ 50 }} characters',
    )]
    private ?string $util_adresse = null;


    #[ORM\Column(length: 20)]
    #[Assert\NotBlank]
    #[Assert\NotNull]
    #[Assert\Length(
        min: 5,
        max: 20,
        minMessage: 'The code postal must be at least {{ 2 }} characters long',
        maxMessage: 'The code postal cannot be longer than {{ 50 }} characters',
    )]
    private ?string $util_cp = null;


    #[ORM\Column(length: 50)]
    #[Assert\NotBlank]
    #[Assert\NotNull]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'The city name must be at least {{ 2 }} characters long',
        maxMessage: 'The city name cannot be longer than {{ 50 }} characters',
    )]
    private ?string $util_ville = null;



    #[ORM\Column(type: 'json')]
    #[Assert\NotNull]
    private array $roles = [];



    #[ORM\OneToMany(mappedBy: 'com_utilisateur', targetEntity: Commande::class, orphanRemoval:true)]
    private Collection $util_commandes;

    public function __construct()
    {
        $this->util_commandes = new ArrayCollection();
    }

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



    /**
     * Get the value of plainPassword
     */ 
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * Set the value of plainPassword
     *
     * @return  self
     */ 
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }



    /** 
     *@see PasswordAuthenticatedUserInterface 
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $util_password): self
    {
        $this->password = $util_password;

        return $this;
    }



    /** 
     *@see UserInterface 
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getUtilAdresse(): ?string
    {
        return $this->util_adresse;
    }

    public function setUtilAdresse(string $util_adresse): self
    {
        $this->util_adresse = $util_adresse;

        return $this;
    }

    public function getUtilCp(): ?string
    {
        return $this->util_cp;
    }

    public function setUtilCp(string $util_cp): self
    {
        $this->util_cp = $util_cp;

        return $this;
    }

    public function getUtilVille(): ?string
    {
        return $this->util_ville;
    }

    public function setUtilVille(string $util_ville): self
    {
        $this->util_ville = $util_ville;

        return $this;
    }


    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->util_email;
    }


    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles =$this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }


    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }



    /**
     * @return Collection<int, Commande>
     */
    public function getUtilCommandes(): Collection
    {
        return $this->util_commandes;
    }

    public function addUtilCommande(Commande $utilCommande): self
    {
        if (!$this->util_commandes->contains($utilCommande)) {
            $this->util_commandes->add($utilCommande);
            $utilCommande->setComUtilisateur($this);
        }

        return $this;
    }

    public function removeUtilCommande(Commande $utilCommande): self
    {
        if ($this->util_commandes->removeElement($utilCommande)) {
            // set the owning side to null (unless already changed)
            if ($utilCommande->getComUtilisateur() === $this) {
                $utilCommande->setComUtilisateur(null);
            }
        }

        return $this;
    }

}
