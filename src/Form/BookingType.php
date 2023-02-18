<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class BookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'rounded-sm mb-1 p-5 text-black w-64 h-9 text-input',
                    'placeholder' => 'Entrez votre nom',
                ],
                "required" => true,
            ])
            ->add('guestNumber', ChoiceType::class, [
                'placeholder' => "Nombre de couverts",
                'attr' => [
                    'class' => 'rounded-sm pl-0 xs:pr-3 selector-booking',
                ],
                'choices' => [
                    '1 personne' => 1,
                    '2 personnes' => 2,
                    '3 personnes' => 3,
                    '4 personnes' => 4,
                    '5 personnes' => 5,
                    '6 personnes' => 6,
                    '7 personnes' => 7,
                    '8 personnes' => 8,
                ],
                'multiple' => false,
                'expanded' => false,
                "required" => true
            ])
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'html5' => true,
                'attr' => [
                    'class' => 'rounded-sm mb-1'
                ],
                "required" => true
            ])
            ->add('bookingTime', ChoiceType::class, [
                'placeholder' => "Heure de réservation",
                'attr' => [
                    'class' => 'reservation-button',
                ],
                'choices' => [
                    '12:00' => '12:00',
                    '12:15' => '12:15',
                    '12:30' => '12:30',
                    '12:45' => '12:45',
                    '13:00' => '13:00',
                    '13:15' => '13:15',
                    '13:30' => '13:30',
                    '19:00' => '19:00',
                    '19:15' => '19:15',
                    '19:30' => '19:30',
                    '19:45' => '19:45',
                    '20:00' => '20:00',
                    '20:15' => '20:15',
                    '20:30' => '20:30'
                ],
                'multiple' => false,
                'expanded' => false,
                "required" => true
            ])
            ->add('allergies', TextType::class, [
                'attr' => [
                    'placeholder' => 'Allergies?',
                    'class' => 'rounded-sm mb-1 p-5 text-black w-64 h-9'
                ],
                "required" => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'csrf_protection' => true,
            'invalid_message' => 'Identifiants invalides.',
        ]);
    }
}
