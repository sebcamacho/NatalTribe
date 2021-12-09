<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Repository\CreneauRepository;
use App\Repository\ReservationRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
    #[Route('/reservation', name: 'reservation')]
    public function index(CreneauRepository $creneauRepository): Response
    {
        $creneaux = $creneauRepository->findAll();
        
        return $this->render('reservation/index.html.twig', [
            'creneaux' => $creneaux
        ]);
    }

    #[Route('/get-reservation/{id}', name: 'get_reservation')]
    public function getResa($id, CreneauRepository $creneauRepository, EntityManagerInterface $manager, ReservationRepository $reservationRepository): Response
    {
        $reservation = new Reservation;
        $user = $this->getUser();
        $creneau = $creneauRepository->find($id);
        $test = $reservationRepository->findOneBy(['user' => $user, 'creneau' => $creneau]);
        
        if(is_null($test)){
            $reservation->setUser($user)->setCreneau($creneau);

        $manager->persist($reservation);
        $manager->flush();

        }else{

            $this->addFlash('message', 'Vous avez déjà réservé ce cours' );
        }
        

        

        
        return $this->redirectToRoute('reservation');
    }
}
