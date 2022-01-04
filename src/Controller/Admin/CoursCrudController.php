<?php

namespace App\Controller\Admin;

use App\Entity\Cours;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ColorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;

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
            TextEditorField::new('description'),
            MoneyField::new('prix')->setCurrency('EUR'),
            TextareaField::new('lieu')->setLabel('Lieu du cours'),
            ImageField::new('image')
                ->setBasePath('assets/images/')
                ->setUploadDir('public/assets/images/')
                ->setUploadedFileNamePattern('[randomhash],[extension]')
                ->setRequired(false),
            IntegerField::new('user_max')->setLabel('Nbr participants max'),
            ColorField::new('bgColor')->setLabel('Couleur de fond (planning)'),
            ColorField::new('borderColor')->setLabel('Couleur bord (planning)'),
            ColorField::new('textColor')->setLabel('Couleur du texte (planning)')
        ];
    }
    
}
