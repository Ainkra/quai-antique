<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class BookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('name', TextType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('guestNumber', ChoiceType::class, [
                'placeholder' => "Nombre de couverts",
                'attr' => [
                    'class' => 'register-guest-field',
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
                    // ...
                ],
                'multiple' => false,
                'expanded' => false,
                "required" => true
            ])
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'html5' => true,
                'attr' => ['class' => 'form-control']
            ])
            ->add('bookingTime', ChoiceType::class, [
                'label' => 'Heure de réservation',
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
                'attr' => [
                    'class' => 'reservation-button', // Ajoutez la classe CSS ici
                ],
                'expanded' => true,
            ])
            ->add('allergies', ChoiceType::class, [
                'attr' => [
                    'class' => 'register-allergies-field',
                ],
                'placeholder' => "Allergies",
                'choices' => [
                    'Aucune' => 1,
                    'Oeufs' => 2,
                    'Fruits à coque' => 3,
                    'Lait' => 4,
                    'Moutarde' => 5,
                    'Blé et Triticales' => 6,
                    'Autre' => 7,
                ],
                'multiple' => true,
                'expanded' => false,
                "required" => true
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
