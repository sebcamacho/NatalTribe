<?php

namespace App\Controller\Admin;

use App\Entity\Cours;
use App\Entity\Reservation;
use App\Form\ReservationType;
use App\Repository\CoursRepository;
use App\Repository\CreneauRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ColorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use SebastianBergmann\CodeCoverage\Report\Html\Renderer;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CoursCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Cours::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
         
            TextField::new('nom'),
            AssociationField::new('categorie_cours'),
            AssociationField::new('type'),
            TextareaField::new('description'),
            MoneyField::new('prix')->setCurrency('EUR'),
            TextareaField::new('lieu')->setLabel('Lieu du cours'),
            ImageField::new('image')
                ->setBasePath('assets/images/')
                ->setUploadDir('public/assets/images/')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
            IntegerField::new('user_max')->setLabel('Nbr participants max'),
            ColorField::new('bgColor')->setLabel('Couleur de fond (planning)'),
            ColorField::new('borderColor')->setLabel('Couleur bord (planning)'),
            ColorField::new('textColor')->setLabel('Couleur du texte (planning)')
        ];
    }

    #[Route('/cours', name: 'cours')]
    public function show( CoursRepository $coursRepository, CreneauRepository $creneauRepository, Request $request){
        
        $cours = $coursRepository->findAll();
        $creneaux = $creneauRepository->findAll();
        // $creneaus = $coursRepository->findBy(['cours' => 'creneaus']);
        
        $reservation = new Reservation;
        $form = $this->createForm(ReservationType::class, $reservation);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($reservation);
            $em->flush();

            return $this->redirectToRoute('');
        }


        return $this->render('cours/cours.html.twig', [
            'cours' => $cours,
            'creneaux' => $creneaux,
            'form' => $form->createView(),
            
        ]);
    }

   
    
}
