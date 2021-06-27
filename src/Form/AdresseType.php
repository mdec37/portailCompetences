<?php

namespace App\Form;

use App\Entity\Adresse;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdresseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('telephone', TextType::class, [
                'label' => 'Numéro de téléphone',
                'attr'  => [
                    'class' => 'inputAdresseTel'
                ]
            ])
            ->add('numero', TextType::class, [
                'label' => 'Numéro',
                'attr'  => [
                    'class' => 'inputAdresse'
                ]
            ])
            ->add('adresse', TextareaType::class, [
                'label' => 'Rue',
                'attr'  => [
                    'class' => 'inputAdresse'
                ]
            ])
            ->add('codePostal', TextType::class, [
                'label' => 'Code postal',
                'attr'  => [
                    'class' => 'inputAdresse'
                ]
            ])
            ->add('ville', TextType::class, [
                'label' => 'Ville',
                'attr'  => [
                    'class' => 'inputAdresse'
                ]
            ])
            ->add('register', SubmitType::class, [
                'label' => 'Enregistrer',
                'attr'  => [
                    'class' => 'buttonAdresse'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Adresse::class,
        ]);
    }
}
