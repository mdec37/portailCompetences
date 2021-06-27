<?php

namespace App\Controller\Admin;

use App\Entity\Entreprises;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class EntreprisesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Entreprises::class;
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
