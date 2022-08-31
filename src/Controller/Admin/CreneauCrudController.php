<?php

namespace App\Controller\Admin;

use App\Entity\Creneau;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class CreneauCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Creneau::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            
            DateField::new('date')->setFormat('short'),
            TimeField::new('heure_debut')->renderAsChoice()->setFormat('short'),
            TimeField::new('heure_fin')->renderAsChoice()->setFormat('short'),
            IntegerField::new('nbr_reservation')->setValue(0)->hideOnForm(),
            AssociationField::new('cours'),
            
        ];
    }
    
}
