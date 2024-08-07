<?php

namespace App\Form;

use App\Entity\RemainingPlaces;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RemainingPlacesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('places', IntegerType::class, [ // Use NumberType input
                'attr' => [
                    'form_attr' => true,
                    'class' => 'text-black lg:text-xl xs:text-lg',
                    'min' => 0,
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RemainingPlaces::class,
        ]);
    }
}
