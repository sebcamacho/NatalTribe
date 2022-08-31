<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Null_;

/**
 * @ORM\Entity(repositoryClass=ReservationRepository::class)
 */
class Reservation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;



    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="reservations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Creneau::class, inversedBy="reservations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $creneau;



 

    

    public function getId(): ?int
    {
        return $this->id;
    }

      public function __toString()
    {
        return $this->creneau ;
       
    }

   

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    // public function getDateTime(): ?string
    // {
    //     $dateTime = 'Le ' . $this->creneau->getDate()->format('Y-m-d') . ' de ' . $this->creneau->getHeureDebut()->format('H:i') . ' à ' . $this->creneau->getHeureFin()->format('H:i');

    //     return $this->$dateTime;
    // }

    public function getCreneau(): ?Creneau
    {
        return $this->creneau;
    }

    public function setCreneau(?Creneau $creneau): self
    {
        $this->creneau = $creneau;

        return $this;
    }


}
