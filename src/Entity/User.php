<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = ['ROLE_CANDIDAT'];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\OneToMany(targetEntity=Competences::class, mappedBy="lienUser")
     */
    private $competences;

    /**
     * @ORM\OneToOne(targetEntity=Adresse::class, fetch="EAGER", inversedBy="user", cascade={"persist", "remove"})
     */
    private $adresse;

    /**
     * @ORM\OneToMany(targetEntity=Experiences::class, mappedBy="user")
     */
    private $experiences;

    public function __construct()
    {
        $this->competences = new ArrayCollection();
        $this->experiences = new ArrayCollection();
    }

//    /**
//     * @ORM\Column(type="datetime")
//     */
//    private $createAt;


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

    public function __toString(){
        return $this -> nom;
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
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getUsername()
    {
        // TODO: Implement getUsername() method.
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

//    public function getCreateAt(): ?\DateTimeInterface
//    {
//        return $this->createAt;
//    }
//
//    public function setCreateAt(\DateTimeInterface $createAt): self
//    {
//        $this->createAt = $createAt;
//
//        return $this;
//    }


/**
 * @return Collection|Competences[]
 */
public function getCompetences(): Collection
{
    return $this->competences;
}

public function addCompetence(Competences $competence): self
{
    if (!$this->competences->contains($competence)) {
        $this->competences[] = $competence;
    }

    return $this;
}

public function removeCompetence(Competences $competence): self
{
    $this->competences->removeElement($competence);

    return $this;
}

public function getAdresse(): ?adresse
{
    return $this->adresse;
}

public function setAdresse(?adresse $adresse): self
{
    $this->adresse = $adresse;

    return $this;
}

//LAISSER VIDE
    public function setCreateAt(\DateTime $now)
    {
    }

    public function setModifiedAt(\DateTime $now)
    {
    }

    /**
     * @return Collection|Experiences[]
     */
    public function getExperiences(): Collection
    {
        return $this->experiences;
    }

    public function addExperience(Experiences $experience): self
    {
        if (!$this->experiences->contains($experience)) {
            $this->experiences[] = $experience;
            $experience->setUser($this);
        }

        return $this;
    }

    public function removeExperience(Experiences $experience): self
    {
        if ($this->experiences->removeElement($experience)) {
            // set the owning side to null (unless already changed)
            if ($experience->getUser() === $this) {
                $experience->setUser(null);
            }
        }

        return $this;
    }

}
