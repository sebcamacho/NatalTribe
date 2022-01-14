<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApprocheController extends AbstractController
{
    #[Route('/approche', name: 'approche')]
    public function index(): Response
    {
        return $this->render('home/approche.html.twig');
    }
}
