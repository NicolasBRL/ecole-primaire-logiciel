<?php

namespace App\Form;

use App\Entity\Classes;
use App\Entity\Professeurs;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClassesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('professeur', EntityType::class, [
                'class' => Professeurs::class,
                'choice_label' => function (Professeurs $professeur) {
                    return $professeur->getPrenom() . ' ' . $professeur->getNom();},
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Classes::class,
        ]);
    }
}
