<?php

namespace App\Entity;

use App\Repository\CoursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CoursRepository::class)
 */
class Cours
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
     * @ORM\ManyToOne(targetEntity=CategorieCours::class, inversedBy="cours")
     */
    private $categorie_cours;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="integer")
     */
    private $user_max;

    /**
     * @ORM\OneToMany(targetEntity=Creneau::class, mappedBy="cours", orphanRemoval=true, fetch="EAGER")
     */
    private $creneaus;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $bgColor;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $borderColor;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $textColor;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $prix;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $lieu;

public function __toString()
    {
        return $this->nom;
        return $this->getCreneaus();
    }



    public function __construct()
    {
        $this->creneaus = new ArrayCollection();
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



    public function getCategorieCours(): ?CategorieCours
    {
        return $this->categorie_cours;
    }

    public function setCategorieCours(?CategorieCours $categorie_cours): self
    {
        $this->categorie_cours = $categorie_cours;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getUserMax(): ?int
    {
        return $this->user_max;
    }

    public function setUserMax(int $user_max): self
    {
        $this->user_max = $user_max;

        return $this;
    }

    /**
     * @return Collection|Creneau[]
     */
    public function getCreneaus(): Collection
    {
        return $this->creneaus;
    }

    public function addCreneau(Creneau $creneau): self
    {
        if (!$this->creneaus->contains($creneau)) {
            $this->creneaus[] = $creneau;
            $creneau->setCours($this);
        }

        return $this;
    }

    public function removeCreneau(Creneau $creneau): self
    {
        if ($this->creneaus->removeElement($creneau)) {
            // set the owning side to null (unless already changed)
            if ($creneau->getCours() === $this) {
                $creneau->setCours(null);
            }
        }

        return $this;
    }

    public function getBgColor(): ?string
    {
        return $this->bgColor;
    }

    public function setBgColor(?string $bgColor): self
    {
        $this->bgColor = $bgColor;

        return $this;
    }

    public function getBorderColor(): ?string
    {
        return $this->borderColor;
    }

    public function setBorderColor(?string $borderColor): self
    {
        $this->borderColor = $borderColor;

        return $this;
    }

    public function getTextColor(): ?string
    {
        return $this->textColor;
    }

    public function setTextColor(?string $textColor): self
    {
        $this->textColor = $textColor;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(?float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(?string $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
    }
}
