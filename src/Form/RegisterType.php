<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Context\ExecutionContext;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'attr' => ['autocomplete' => 'email'],
                "required" => true
            ])
            ->add('password', PasswordType::class, [
                "required" => true,
                "constraints" => [new Length([
                        'min' => 6, 
                        'minMessage' => 'Chaîne de caractères trop courte.', 
                        'max' => 60,
                    ])
                ],
                'attr' => ['autocomplete' => 'new-password'],
            ])
            ->add('confirm', PasswordType::class, [
                "required" => true,
                "constraints" => [
                    new Length([
                        'min' => 6, 
                        'minMessage' => 'Chaîne de caractères trop courte.', 
                        'max' => 60,
                    ]),
                    new NotBlank([
                        'message' => "Veuillez remplir ce champ."
                    ]),
                    new Callback([
                        'callback' => function ($value, ExecutionContext $ec) 
                    {
                        if ($ec->getRoot()['password']->getViewData() !== $value) 
                        {
                            $ec->addViolation("Les mots de passe ne sont pas identiques.");
                        }
                    }])
                ]
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
            ->add('allergies', TextType::class, [
                'attr' => [
                    'placeholder' => 'Allergies?'
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
