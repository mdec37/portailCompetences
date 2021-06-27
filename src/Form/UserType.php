<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prenom', TextType::class, [
                'required'    => true,
                'label' => 'Prénom',
                'constraints' => [
                    new Length(
                        [
                            'min' => 2,
                            'max' => 50
                        ]
                    )
                ],
                'attr'  => [
                    'class' => 'inputRegister'
                ],
            ])
            ->add('nom', TextType::class, [
                'required'    => true,
                'label' => 'Nom',
                'constraints' => [
                    new Length(
                        [
                            'min' => 2,
                            'max' => 50
                        ]
                    )
                ],
                'attr'  => [
                    'class' => 'inputRegister'
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Adresse mail',
                'attr'  => [
                    'placeholder' => 'Merci de saisir votre adresse mail.',
                    'class' => 'inputRegister'
                ],
                'required'    => true
            ])
            ->add('password', RepeatedType::class, [
                'type'            => PasswordType::class,
                'invalid_message' => 'Le mot de passe et la confirmation doivent être identique',
                'required'        => true,
                'first_options'   => [
                    'label' => 'Mot de passe',
                    'attr'  => [
                        'placeholder' => 'Merci de saisir votre mot de passe.',
                        'class' => 'inputRegister'
                    ]
                ],
                'second_options'  => [
                    'label' => 'Confirmez le mot de passe',
                    'attr'  => [
                        'placeholder' => 'Merci de confirmer votre mot de passe.',
                        'class' => 'inputRegister'
                    ]
                ]
            ])
            ->add('register', SubmitType::class, [
                'label' => 'Enregistrer',
                'attr' => [
                    'class' => 'buttonRegister'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
