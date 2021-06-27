<?php

namespace App\Controller\Admin;

use App\Entity\Experiences;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ExperiencesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Experiences::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('user', "Salarié"),
            TextField::new('nom', "Titre"),
            TextField::new('entreprises_txt', 'Entreprise'),
            TextareaField::new('description', 'Description')
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL, 'ROLE_ADMIN')
            ->setPermission(Action::NEW, 'ROLE_ADMIN')
            ->setPermission(Action::DETAIL, 'ROLE_ADMIN')
            ->setPermission(Action::DELETE, 'ROLE_ADMIN')
            ;
    }
}
