<?php

namespace App\Controller\Admin;

use App\Entity\Cours;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ColorField;

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
            ImageField::new('image')
                ->setBasePath('upload_dir')
                ->setUploadDir('public/assets/images')
                ->setUploadedFileNamePattern('[randomhash],[extension]')
                ->setRequired(false),
            IntegerField::new('user_max'),
            ColorField::new('bgColor'),
            ColorField::new('borderColor'),
            ColorField::new('textColor')
        ];
    }
    
}
