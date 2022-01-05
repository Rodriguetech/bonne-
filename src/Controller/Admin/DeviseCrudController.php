<?php

namespace App\Controller\Admin;

use App\Entity\Devise;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class DeviseCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Devise::class;
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
