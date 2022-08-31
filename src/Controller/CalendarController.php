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
        // Penser à récupérer les créneaux futurs
        $events = $creneauRepository->findAll();
        

        $rdvs = [];
        foreach($events as $event){
            $rdvs [] = [
                'id' => $event->getId(),
                'title' => $event->getCours()->getNom(),
                'start' => $event->getDate()->format('Y-m-d') . ' ' . $event->getHeureDebut()->format('H:i:s'),
                'end' => $event->getDate()->format('Y-m-d') . ' ' . $event->getHeureFin()->format('H:i:s'),
                'allDay' => false,
                'backgroundColor' => $event->getCours()->getBgColor(),
                'borderColor' => $event->getCours()->getBorderColor(),
                'textColor' => $event->getCours()->getTextColor(),
                
            ];
        }

        $data = json_encode($rdvs);
        
        

        return $this->render('calendar/all.html.twig', compact('data'));
    }

    #[Route('/calendar/{id}', name: 'oneCoursCalendar')]
    public function displayCalendarByCours($id, CoursRepository $coursRepository): Response
    {
        $cour = $coursRepository->find($id);
       
        $crenauCours = $cour->getCreneaus()->toArray();
   
    

        $rdvs = [];
        foreach($crenauCours as $event){
            $rdvs [] = [
                'id' => $event->getId(),
                'title' => $event->getCours()->getNom(),
                'start' => $event->getDate()->format('Y-m-d') . ' ' . $event->getHeureDebut()->format('H:i:s'),
                'end' => $event->getDate()->format('Y-m-d') . ' ' . $event->getHeureFin()->format('H:i:s'),
                'allDay' => false,
                'backgroundColor' => $event->getCours()->getBgColor(),
                'borderColor' => $event->getCours()->getBorderColor(),
                'textColor' => $event->getCours()->getTextColor(),
                
            ];
        }

        $data = json_encode($rdvs);
        
        

        return $this->render('calendar/byCours.html.twig', compact('data'));
    }


}
