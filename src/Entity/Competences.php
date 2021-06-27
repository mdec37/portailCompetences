<?php

namespace App\Entity;

use App\Repository\CompetencesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CompetencesRepository::class)
 */
class Competences
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="lienCompetences")
     */
    private $lienUser;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $niveau;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $aime;

    /**
     * @ORM\ManyToMany(targetEntity=Categories::class, mappedBy="lienCompetences")
     */
    private $lienCategories;
//
//    /**
//     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="competences")
//     */
//    private $users;

    public function __construct()
    {
        $this->lienCategories = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getLienUser(): ?User
    {
        return $this->lienUser;
    }

    public function setLienUser(?User $lienUser): self
    {
        $this->lienUser = $lienUser;

        return $this;
    }

    public function getNiveau(): ?int
    {
        return $this->niveau;
    }

    public function setNiveau(?int $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }

    public function getAime(): ?bool
    {
        return $this->aime;
    }

    public function setAime(?bool $aime): self
    {
        $this->aime = $aime;

        return $this;
    }

    public function __toString()
    {
        return $this->nom;
    }

    /**
     * @return Collection|Categories[]
     */
    public function getLienCategories(): Collection
    {
        return $this->lienCategories;
    }

    public function addLienCategory(Categories $lienCategory): self
    {
        if (!$this->lienCategories->contains($lienCategory)) {
            $this->lienCategories[] = $lienCategory;
            $lienCategory->addLienCompetence($this);
        }

        return $this;
    }

    public function removeLienCategory(Categories $lienCategory): self
    {
        if ($this->lienCategories->removeElement($lienCategory)) {
            $lienCategory->removeLienCompetence($this);
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addCompetence($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeCompetence($this);
        }

        return $this;
    }
}
