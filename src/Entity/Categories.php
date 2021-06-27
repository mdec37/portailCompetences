<?php

namespace App\Entity;

use App\Repository\CategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoriesRepository::class)
 */
class Categories
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
     * @ORM\ManyToMany(targetEntity=Competences::class, inversedBy="lienCategories")
     */
    private $lienCompetences;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    public function __construct()
    {
        $this->lienCompetences = new ArrayCollection();
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

    public function __toString()
    {
        return $this->nom;
    }

    /**
     * @return Collection|Competences[]
     */
    public function getLienCompetences(): Collection
    {
        return $this->lienCompetences;
    }

    public function addLienCompetence(Competences $lienCompetence): self
    {
        if (!$this->lienCompetences->contains($lienCompetence)) {
            $this->lienCompetences[] = $lienCompetence;
        }

        return $this;
    }

    public function removeLienCompetence(Competences $lienCompetence): self
    {
        $this->lienCompetences->removeElement($lienCompetence);

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }
}
