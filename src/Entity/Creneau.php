<?php

namespace App\Entity;

use App\Repository\CreneauRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CreneauRepository::class)
 */
class Creneau
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     * 
     */
    private $date;

    /**
     * @ORM\Column(type="time")
     * @ORM\JoinColumn(nullable=true)
     * 
     */
    private $heure_debut;

    /**
     * @ORM\Column(type="time")
     * @ORM\JoinColumn(nullable=true)
     */
    private $heure_fin;

    /**
     * @ORM\Column(type="integer")
     * @ORM\JoinColumn(nullable=true)
     */
    private $nbr_reservation;

    /**
     * @ORM\ManyToOne(targetEntity=Cours::class, inversedBy="creneaus")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cours;

    /**
     * @ORM\OneToMany(targetEntity=Reservation::class, mappedBy="creneau", orphanRemoval=true)
     */
    private $reservations;

    // public function __toString()
    // {
    //     return $this->date;
    //     return $this->getDateTime();
    //     return $this->getHeureDebut();
    //     return $this->getHeureFin();
       
    // }


    public function __construct()
    {
        $this->reservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getHeureDebut(): ?\DateTimeInterface
    {
        return $this->heure_debut;
    }

    public function setHeureDebut(\DateTimeInterface $heure_debut): self
    {
        $this->heure_debut = $heure_debut;

        return $this;
    }

    public function getHeureFin(): ?\DateTimeInterface
    {
        return $this->heure_fin;
    }

    public function setHeureFin(\DateTimeInterface $heure_fin): self
    {
        $this->heure_fin = $heure_fin;

        return $this;
    }

    public function getNbrReservation(): ?int
    {
        return $this->nbr_reservation;
    }

    public function setNbrReservation(int $nbr_reservation): self
    {
        $this->nbr_reservation = $nbr_reservation;

        return $this;
    }

    public function getCours(): ?Cours
    {
        return $this->cours;
    }

    public function setCours(?Cours $cours): self
    {
        $this->cours = $cours;

        return $this;
    }

    /**
     * @return Collection|Reservation[]
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations[] = $reservation;
            $reservation->setCreneau($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getCreneau() === $this) {
                $reservation->setCreneau(null);
            }
        }

        return $this;
    }

    public function getDateTime(): ?string
    {

        $dateTime = 'Le ' . $this->getDate()->format('d/m/y') . ' de ' . $this->getHeureDebut()->format('H:i') . ' à ' . $this->getHeureFin()->format('H:i');

        return $dateTime;
    }

    public function compteResa(){

        return count($this->getReservations());
    }
}
