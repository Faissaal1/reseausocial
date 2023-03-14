<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UsersRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class Users implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $date_naissance = null;

    #[ORM\OneToMany(mappedBy: 'sender', targetEntity: Messages::class, orphanRemoval: true)]
    private Collection $sent;

    #[ORM\OneToMany(mappedBy: 'recepient', targetEntity: Messages::class, orphanRemoval: true)]
    private Collection $received;

    #[ORM\OneToMany(mappedBy: 'follower', targetEntity: Follows::class)]
    private Collection $follows;

    public function __construct()
    {
        $this->sent = new ArrayCollection();
        $this->received = new ArrayCollection();
        $this->follows = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        
        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
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
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateNaissance(): ?string
    {
        return $this->date_naissance;
    }

    public function setDateNaissance(string $date_naissance): self
    {
        $this->date_naissance = $date_naissance;

        return $this;
    }

    /**
     * @return Collection<int, Messages>
     */
    public function getSent(): Collection
    {
        return $this->sent;
    }

    public function addSent(Messages $sent): self
    {
        if (!$this->sent->contains($sent)) {
            $this->sent->add($sent);
            $sent->setSender($this);
        }

        return $this;
    }

    public function removeSent(Messages $sent): self
    {
        if ($this->sent->removeElement($sent)) {
            // set the owning side to null (unless already changed)
            if ($sent->getSender() === $this) {
                $sent->setSender(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Messages>
     */
    public function getReceived(): Collection
    {
        return $this->received;
    }

    public function addReceived(Messages $received): self
    {
        if (!$this->received->contains($received)) {
            $this->received->add($received);
            $received->setRecepient($this);
        }

        return $this;
    }

    public function removeReceived(Messages $received): self
    {
        if ($this->received->removeElement($received)) {
            // set the owning side to null (unless already changed)
            if ($received->getRecepient() === $this) {
                $received->setRecepient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Follows>
     */
    public function getFollows(): Collection
    {
        return $this->follows;
    }

    public function addFollow(Follows $follow): self
    {
        if (!$this->follows->contains($follow)) {
            $this->follows->add($follow);
            $follow->setFollower($this);
        }

        return $this;
    }

    public function removeFollow(Follows $follow): self
    {
        if ($this->follows->removeElement($follow)) {
            // set the owning side to null (unless already changed)
            if ($follow->getFollower() === $this) {
                $follow->setFollower(null);
            }
        }

        return $this;
    }
}
