<?php

namespace App\Controller;

use App\Repository\CreneauRepository;
use App\Repository\ReservationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/main', name: 'main')]
    public function index(ReservationRepository $reservationRepository, CreneauRepository $creneauRepository): Response
    {
        $events = $creneauRepository->findAll();

        $rdvs = [];
        foreach($events as $event){
            $rdvs [] = [
                'id' => $event->getId(),
                'title' => $event->getCours()->getNom(),
                'start' => $event->getDate()->format('Y-m-d') . ' ' . $event->getHeureDebut()->format('H:i:s'),
                'end' => $event->getDate()->format('Y-m-d') . ' ' . $event->getHeureFin()->format('H:i:s'),
                'allDay' => false
            ];
        }

        $data = json_encode($rdvs);

        return $this->render('main/index.html.twig', compact('data'));
    }


}
