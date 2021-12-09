<?php

namespace App\Controller\Admin;

use App\Entity\CategorieCours;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CategorieCoursCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CategorieCours::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
