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
    public function index(ReservationRepository $reservationRepository): Response
    {
        $user = $this->getUser();
        $reservations = $reservationRepository->findBy(['user' => $user]);
        $actualDate = new DateTime();
        $limitToCancel = new DateTime();
        $limitToCancel->modify('+ 2 day');

        return $this->render('reservation/index.html.twig', [
            'actualDate' => $actualDate,
            'reservations' => $reservations,
            'limit' => $limitToCancel
        ]);
    }

 
    #[Route('/get-reservation', name: 'get_reservation')]
    public function getResa(EntityManagerInterface $manager, Cart $cart, ReservationRepository $reservationRepository): Response
    {
        $user = $this->getUser();
        $reservations = [];
        foreach ($cart->getDetailedCart() as $oneCreneau) {
            /** @var Creneau*/
            $creneau = $oneCreneau['creneau'];
                if($creneau->getNbrReservation() >= $creneau->getCours()->getUserMax()){
                    $this->addFlash('warning', 'La limite de participants pour le créneau '. $creneau->getDateTime() . 'est atteinte, veuillez choisir un autre créneau');
                    $cart->delete($creneau);
                }else{
                    $checkDb = $reservationRepository->findOneBy(['user' => $user, 'creneau' => $creneau]);
                        if(is_null($checkDb)){
                            $reservation = new Reservation;
                            $reservations [] = $reservation->setCreneau($creneau)->setUser($user);
                            $creneau->setNbrReservation($creneau->getNbrReservation()+1);
                            $manager->persist($reservation);}
                        else{
                            $this->addFlash('warning', "Vous avez déjà réservé ce créneau");
                        }
                }
        }
   
        $manager->flush();
        $cart->remove();
        
        return $this->redirectToRoute('reservation');
    }

    #[Route('/delete-reservation/{id}', name: 'delete_reservation')]
    public function deleteResa($id, EntityManagerInterface $manager, ReservationRepository $reservationRepository): Response
    {
        $reservation = $reservationRepository->find($id);
        $manager->remove($reservation);
        $reservation->getCreneau()->setNbrReservation($reservation->getCreneau()->getNbrReservation()-1);
        $manager->flush();

        return $this->redirectToRoute('reservation');
    }
}
