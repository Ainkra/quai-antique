<?php

namespace App\Form;

use App\Entity\Aperitif;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

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
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Regex([
                        'pattern' => '/^[a-zA-Z]+$/',
                        'message' => 'Le nom ne doit contenir que des lettres.',
                    ]),
                ],
                "required" => true
            ])
            ->add('description', TextType::class, [ // Text input type
                'attr' => [
                    'class' => 'card-input',
                    'placeholder' => 'description'
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Regex([
                        'pattern' => '/^[a-zA-Z,]*$/',
                        'message' => 'La description ne doit contenir que des lettres et des virgules.',
                    ]),
                ],
                "required" => true
            ])
            ->add('price', TextType::class, [ // Text input type
                'attr' => [
                    'class' => 'card-input',
                    'placeholder' => '0,00'
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
            'data_class' => Aperitif::class,
        ]);
    }
}
