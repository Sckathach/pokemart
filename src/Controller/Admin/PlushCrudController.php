<?php

namespace App\Controller\Admin;

use App\Entity\Plush;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PlushCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Plush::class;
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
