<?php

namespace App\Form;

use App\Entity\Classes;
use App\Entity\Professeurs;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClassesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'attr' => ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5'],
                'label_attr' => ['class' => 'block mb-2 text-sm font-medium text-gray-900'],
                'row_attr' => ['class' => 'mb-6'],
            ])
            ->add('professeur', EntityType::class, [
                'class' => Professeurs::class,
                'choice_label' => function (Professeurs $professeur) {
                    return $professeur->getPrenom() . ' ' . $professeur->getNom();},
                    
                'attr' => ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5'],
                'label_attr' => ['class' => 'block mb-2 text-sm font-medium text-gray-900'],
                'row_attr' => ['class' => 'mb-6'],
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
