<?php

namespace App\Form;

use App\Entity\Experiences;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExperiencesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class,[
                'label'=>"Libelé",
                'attr'  => [
                    'class' => 'inputExperiences'
                ]])
            ->add('entreprises_txt', TextType::class,[
                'label'=>"Entreprise",
                'attr'  => [
                    'class' => 'inputExperiences'
                ]])
            ->add('description',TextareaType::class,[
                'label'=>"Description",
                'attr'  => [
                    'class' => 'inputExperiences'
                ]])
            ->add('submit', SubmitType::class,[
                'label'=>"Enregistrer",
                'attr'  => [
                    'class' => 'buttonExperiences'
                ]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Experiences::class,
        ]);
    }
}
