<?php

namespace App\Form;

use App\Entity\Desserts;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DessertType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => [
                    'class' => 'card-input',
                    'placeholder' => 'titre'
                ],
                "required" => true
            ])
            ->add('description', TextType::class, [
                'attr' => [
                    'class' => 'card-input',
                    'placeholder' => 'description'
                ],
                "required" => true
            ])
            ->add('price', TextType::class, [
                'attr' => [
                    'class' => 'card-input',
                    'placeholder' => 'prix'
                ],
                "required" => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Desserts::class,
        ]);
    }
}
