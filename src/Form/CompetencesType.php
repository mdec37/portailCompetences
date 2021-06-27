<?php

namespace App\Form;

use App\Entity\Competences;
use Doctrine\DBAL\Types\BooleanType;
use EasyCorp\Bundle\EasyAdminBundle\Form\Filter\Type\TextFilterType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class CompetencesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class,[
                'label'=>"Nom",
                'attr'  => [
                    'class' => 'inputCompetences'
                ]])
            ->add('niveau', IntegerType::class,[
                'label'=>"Niveau",
                'attr'  => [
                    'class' => 'inputCompetences'
                ]])
            ->add('aime', ChoiceType::class,[
                'label'=>"Appréciation",
                'choices'  => [
                    'Oui' => true,
                    'Non' => false,
                ]])
            ->add('submit', SubmitType::class,[
                'label'=>"Enregistrer",
                'attr'  => [
                    'class' => 'buttonCompetences'
                ]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Competences::class,
        ]);
    }
}
