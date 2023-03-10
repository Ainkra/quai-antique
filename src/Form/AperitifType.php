<?php

namespace App\Form;

use App\Entity\Aperitif;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AperitifType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [ // Text input type
                'attr' => [
                    'class' => 'card-input',
                    'placeholder' => 'titre'
                ],
                "required" => true
            ])
            ->add('description', TextType::class, [ // Text input type
                'attr' => [
                    'class' => 'card-input',
                    'placeholder' => 'description'
                ],
                "required" => true
            ])
            ->add('price', TextType::class, [ // Text input type
                'attr' => [
                    'class' => 'card-input',
                    'placeholder' => 'price'
                ],
                "required" => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Aperitif::class,
        ]);
    }
}
