<?php

namespace App\Entity;

use DateTime;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="`user`")
 * @UniqueEntity(fields={"email"}, message="Cette email est déjà utilisée")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\Email()
     */
    private string $email = '';

    /**
     * @ORM\Column(type="json")
     */
    private array $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Assert\Length(min="8", minMessage="Votre mot de passe doit faire minimum 8 caractères")
     * @Assert\Regex(pattern = "/^\S*(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W|_])\S*$/", message="Votre mot de passe doit contenir au moins : 1 majuscule, 1 chiffre et 1 caractère spécial")
     */
    private string $password = '';

    /**
     * @Assert\EqualTo(propertyPath="password", message="les mots de passes ne sont pas identiques")
     */
    private string $confirm_password = '';

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $firstname = '';

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $lastname = '';

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?\DateTimeInterface $last_sign_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private \DateTimeInterface $created_at;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $reset_pwd_token;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?\DateTimeInterface $reset_pwd_at;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $opt_in = false;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?\DateTimeInterface $validate_at;

    /**
     * @ORM\OneToMany(targetEntity=Planning::class, mappedBy="user_id", orphanRemoval=true)
     */
    private $plannings;

    public function __construct()
    {
        $this->setCreatedAt( new DateTime());
        $this->plannings = new ArrayCollection();
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
    public function getUsername(): string
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
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getConfirmPassword(): string
    {
        return (string) $this->confirm_password;
    }

    public function setConfirmPassword(string $confirm_password): self
    {
        $this->confirm_password = $confirm_password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt() : ?string
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials() : void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getLastSignAt(): ?DateTimeInterface
    {
        return $this->last_sign_at;
    }

    public function setLastSignAt(?DateTimeInterface $last_sign_at): self
    {
        $this->last_sign_at = $last_sign_at;

        return $this;
    }

    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getResetPwdToken(): ?string
    {
        return $this->reset_pwd_token;
    }

    public function setResetPwdToken(?string $reset_pwd_token): self
    {
        $this->reset_pwd_token = $reset_pwd_token;

        return $this;
    }

    public function getResetPwdAt(): ?DateTimeInterface
    {
        return $this->reset_pwd_at;
    }

    public function setResetPwdAt(?DateTimeInterface $reset_pwd_at): self
    {
        $this->reset_pwd_at = $reset_pwd_at;

        return $this;
    }

    public function getOptIn(): ?bool
    {
        return $this->opt_in;
    }

    public function setOptIn(bool $opt_in): self
    {
        $this->opt_in = $opt_in;

        return $this;
    }

    public function getValidateAt(): ?\DateTimeInterface
    {
        return $this->validate_at;
    }

    public function setValidateAt(?\DateTimeInterface $validate_at): self
    {
        $this->validate_at = $validate_at;

        return $this;
    }

    /**
     * @return Collection|Planning[]
     */
    public function getPlannings(): Collection
    {
        return $this->plannings;
    }

    public function addPlanning(Planning $planning): self
    {
        if (!$this->plannings->contains($planning)) {
            $this->plannings[] = $planning;
            $planning->setUserId($this);
        }

        return $this;
    }

    public function removePlanning(Planning $planning): self
    {
        if ($this->plannings->contains($planning)) {
            $this->plannings->removeElement($planning);
            // set the owning side to null (unless already changed)
            if ($planning->getUserId() === $this) {
                $planning->setUserId(null);
            }
        }

        return $this;
    }
}
