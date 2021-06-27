<?php

namespace App\Controller\Admin;

use App\Entity\Competences;
use App\Entity\User;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\ManyToOne;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Bundle\MakerBundle\Doctrine\RelationManyToMany;

class CompetencesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Competences::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('lienUser', "Salarié"),
            TextField::new('nom', 'Libellé'),
            IntegerField::new('niveau', 'Niveau')
                ->addCssClass('font-italic'),
            BooleanField::new('aime', "Appréciation"),
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
