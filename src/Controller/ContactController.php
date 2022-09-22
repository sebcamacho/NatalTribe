<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use ContainerY6KcZqt\get_Console_Command_SecretsRemove_LazyService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{   
    #[Route('/contact', name: 'contact')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $contact = new Contact();
        
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $entityManager->persist($contact);
            $entityManager->flush();
            // return $this->redirectToRoute('contact');
            $this->addFlash('success', 'Merci de votre message, nous vous répondrons dans les meilleurs délais');
            
        }

        

        return $this->render('contact/index.html.twig', [
            'contactForm' => $form->createView()
        ]);
    }
}
