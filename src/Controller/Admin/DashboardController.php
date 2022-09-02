<?php

namespace App\Controller\Admin;

use App\Controller\MainController;
use App\Entity\Type;
use App\Entity\User;
use App\Entity\Cours;
use App\Entity\Creneau;
use App\Entity\CategorieCours;
use App\Entity\Reservation;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('NatalTribe');
           
    }

    public function configureMenuItems(): iterable
    {
        
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::linkToRoute('Retour au site', 'fas fa-house-user', 'home');

        yield MenuItem::section('Cours');

        yield MenuItem::linkToCrud('Cours', 'fas fa-user-friends', Cours::class);
        yield MenuItem::linkToCrud('Catégorie cours', 'fas fa-list', CategorieCours::class);  
        yield MenuItem::linkToCrud('Créneaux', 'fas fa-calendar', Creneau::class);
        yield MenuItem::section('Utilisateurs');

        yield MenuItem::linkToCrud('Utilisateurs inscrits', 'fas fa-user', User::class);

        yield MenuItem::section('Réservations');
        // yield MenuItem::linkToCrud('Gérer les réservations', 'fas fa-user', Reservation::class);
    }

    
}
