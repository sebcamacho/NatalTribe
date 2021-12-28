<?php

namespace App\Controller\Admin;

use App\Controller\MainController;
use App\Entity\Type;
use App\Entity\User;
use App\Entity\Cours;
use App\Entity\Creneau;
use App\Entity\CategorieCours;
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

        yield MenuItem::section('Cours');

        yield MenuItem::linkToCrud('Cours', 'fas fa-user-friends', Cours::class);
        yield MenuItem::linkToCrud('Catégorie cours', 'fas fa-tags', CategorieCours::class);
        yield MenuItem::linkToCrud('Type cours', 'fas fa-tags', Type::class);    
        yield MenuItem::linkToCrud('Creneau', 'fas fa-calendar', Creneau::class);

        yield MenuItem::section('Vidéos');

        yield MenuItem::section('Utilisateurs');

        yield MenuItem::linkToCrud('Users', 'fas fa-user', User::class);
    }

    
}
