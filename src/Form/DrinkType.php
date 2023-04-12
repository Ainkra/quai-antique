<?php

namespace App\Form;

use App\Entity\Drink;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class DrinkType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => [
                    'class' => 'card-input',
                    'placeholder' => 'titre'
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Regex([
                        'pattern' => '/^[a-zA-Z]+$/',
                        'message' => 'Le nom ne doit contenir que des lettres.',
                    ]),
                ],
                "required" => true
            ])
            ->add('price', TextType::class, [
                'attr' => [
                    'class' => 'card-input',
                    'placeholder' => 'prix'
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Regex([
                        'pattern' => '/^[0-9,]+$/',
                        'message' => 'Le prix ne doit contenir que des chiffres et des virgules.',
                    ]),
                ],
                "required" => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Drink::class,
        ]);
    }
}
