<?php

namespace App\Controller;

use App\Service\Cart;
use App\Entity\Creneau;
use App\Entity\Reservation;
use Doctrine\ORM\EntityManager;
use App\Repository\CreneauRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ReservationRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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

    #[Route('/détail-reservation/{id}', name: 'reservation_detail')]
    public function detailResa($id, CreneauRepository $creneauRepository): Response
    {
        $creneau = $creneauRepository->find($id);
        
        return $this->render('reservation/detail.html.twig', [
            'creneau' => $creneau
        ]);
    }

    #[Route('/get-reservation', name: 'get_reservation')]
    public function getResa(EntityManagerInterface $manager, Cart $panier, ReservationRepository $reservationRepository): Response
    {
        $user = $this->getUser();
        $reservation = new Reservation;
        $reservation->setUser($user);
        
        foreach ($panier->getDetailedCart() as $oneCreneau) {

            /** @var Creneau*/
            $creneau = $oneCreneau['creneau'];
            
                if($creneau->getNbrReservation() >= $creneau->getCours()->getUserMax()){
                //message flash pour dire que la reservation de ce cours est impossible
                $this->addFlash('warning', 'La limite de participants pour le créneau est atteinte, veuillez choisir un autre créneau');
            }

            $test = $reservationRepository->findOneBy(['user' => $user, 'creneau' => $creneau]);

            if(is_null($test)){
                $reservation = new Reservation;
                $reservation->setCreneau($creneau)->setUser($user);
                $creneau->setNbrReservation(1);
                $manager->persist($reservation);}
            else{
                $this->addFlash('warning', "Vous avez déjà réservé ce créneau");
            }
        }
        
        $manager->flush();

        $panier->remove();
        
        return $this->redirectToRoute('cart');

    }
}
