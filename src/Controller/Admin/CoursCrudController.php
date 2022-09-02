<?php

namespace App\Controller\Admin;

use App\Entity\Cours;
use App\Entity\Creneau;
use App\Entity\Reservation;
use App\Form\ReservationType;
use App\Repository\CoursRepository;
use App\Repository\CreneauRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ReservationRepository;
use DateTime;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Collections\ArrayCollection;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ColorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use Symfony\Component\DomCrawler\Field\FileFormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use SebastianBergmann\CodeCoverage\Report\Html\Renderer;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\Validator\Constraints\Date;

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
            TextEditorField::new('description'),
            MoneyField::new('prix')->setCurrency('EUR'),
            TextEditorField::new('lieu')->setLabel('Lieu du cours'),
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
    public function showAll(CoursRepository $coursRepository, CreneauRepository $creneauRepository, ReservationRepository $reservationRepository, Request $request, EntityManagerInterface $manager){
        
        $cours = $coursRepository->findAll();
        $creneaux = $creneauRepository->findAll();

        return $this->render('cours/cours.html.twig', [
            'cours' => $cours,
            'creneaux' => $creneaux,
           
        ]);
    }


    #[Route('/cours/{id}', name: 'oneCours')]
    public function showOne($id, CoursRepository $coursRepository, CreneauRepository $creneauRepository){
        
        $cours = $coursRepository->find($id);
       
        $creneaux = $cours->getCreneaus()->toArray();

        foreach ($creneaux as $creneau) {
            
            /** @var Creneau */
            $creneauDate = $creneau;
            $creneauDate = $creneauDate->getDate();

        }
        $dayDate = new DateTime();

        return $this->render('cours/vue-cours.html.twig', [
            'cours' => $cours,
            'creneaux' => $creneaux,
            'creneauDate' => $creneauDate,
            'dayDate' => $dayDate
           
        ]);
    }
   
    
}
