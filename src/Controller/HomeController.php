<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

    #[Route('/cgu', name: 'cgu')]
    public function goToCgu(): Response
    {
        return $this->render('home/cgu.html.twig');
    }

    #[Route('/sitemap.xml', name: 'sitemap')]
    public function siteMap(): Response
    {
        return $this->render('sitemap.xml');
    }
}
