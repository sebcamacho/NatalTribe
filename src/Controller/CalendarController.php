<?php

namespace App\Controller;


use App\Repository\CoursRepository;
use App\Repository\CreneauRepository;
use App\Repository\ReservationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalendarController extends AbstractController
{
    #[Route('/calendar', name: 'calendar')]
    public function displayCalendar(ReservationRepository $reservationRepository, CreneauRepository $creneauRepository): Response
    {
        $events = $creneauRepository->findAll();

        $rdvs = [];
        foreach($events as $event){
            $rdvs [] = [
                'id' => $event->getId(),
                'title' => $event->getCours()->getNom(),
                'start' => $event->getDate()->format('Y-m-d') . ' ' . $event->getHeureDebut()->format('H:i:s'),
                'end' => $event->getDate()->format('Y-m-d') . ' ' . $event->getHeureFin()->format('H:i:s'),
                'allDay' => false,
                'url' => 'http://127.0.0.1:8000/détail-reservation/' . $event->getId(),
                'backgroundColor' => $event->getCours()->getBgColor(),
                'borderColor' => $event->getCours()->getBorderColor(),
                'textColor' => $event->getCours()->getTextColor()
            ];
        }

        $data = json_encode($rdvs);
        
        

        return $this->render('calendar/index.html.twig', compact('data'));
    }


}
