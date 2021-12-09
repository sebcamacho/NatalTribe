<?php

namespace App\Controller\Admin;

use App\Entity\Type;
use App\Entity\Cours;
use App\Entity\CategorieCours;
use App\Entity\Creneau;
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
        yield MenuItem::linkToCrud('Catégorie cours', 'fas fa-list', CategorieCours::class);
        yield MenuItem::linkToCrud('Type cours', 'fas fa-list', Type::class);
        yield MenuItem::linkToCrud('Cours', 'fas fa-list', Cours::class);
        yield MenuItem::linkToCrud('Creneau', 'fas fa-list', Creneau::class);
    }
}
