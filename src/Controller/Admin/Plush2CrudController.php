<?php

namespace App\Controller\Admin;

use App\Entity\Plush;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class Plush2CrudController extends AbstractCrudController
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
