<?php

namespace App\Controller;

use App\Service\Cart;
use App\Entity\Creneau;
use App\Entity\Reservation;
use App\Repository\CreneauRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ReservationRepository;
use DateTime;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReservationController extends AbstractController
{
    #[Route('/reservation', name: 'reservation')]
    public function index(ReservationRepository $reservationRepository, CreneauRepository $creneauRepository): Response
    {
        
        $user = $this->getUser();
        
       /** @var Reservation */
        $reservations = $reservationRepository->findBy(['user' => $user]);

        $actualDate = new DateTime();

            foreach ($reservations as $reservation) {

                $creneauId = $reservation->getCreneau()->getId();

                /** @var Creneau */
                $creneaux [] = $creneauRepository->find($creneauId);     
                
            }

        return $this->render('reservation/index.html.twig', [
            'creneaux' => $creneaux,
            'actualDate' => $actualDate
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
              
                $this->addFlash('warning', 'La limite de participants pour le créneau '. $creneau->getDateTime() . 'est atteinte, veuillez choisir un autre créneau');
                $panier->delete($creneau);
                }else{

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
}
