<?php

namespace App\Form;

use App\Entity\Starter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class StarterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => [
                    'class' => 'card-input'
                ],
                "required" => true
            ])
            ->add('description', TextType::class, [
                'attr' => [
                    'class' => 'card-input'
                ],
                "required" => true
            ])
            ->add('price', TextType::class, [
                'attr' => [
                    'class' => 'card-input'
                ],
                "required" => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Starter::class,
        ]);
    }
}

// #[IsGranted('ROLE_ADMIN')]
// public function admin(Request $request, ManagerRegistry $doctrine)
// {
//     $entityManager = $doctrine->getManager();
//     $dishes = $entityManager->getRepository(Dish::class)->findAll();
//     $desserts = $entityManager->getRepository(Desserts::class)->findAll();
//     $starters = $entityManager->getRepository(Starter::class)->findAll();
//     $cellars = $entityManager->getRepository(Cellar::class)->findAll();
//     $drinks = $entityManager->getRepository(Drink::class)->findAll();
//     // récupération des autres entités à afficher

//     // Création des formulaires d'ajout/suppression
//     $dishForm = $this->createForm(DishType::class);
//     $dishForm->handleRequest($request);

//     if ($dishForm->isSubmitted() && $dishForm->isValid()) {
//         $dish = $dishForm->getData();
//         $entityManager->persist($dish);
//         $entityManager->flush();
//         return $this->redirectToRoute('admin');
//     }

//     $deleteDishForm = $this->createFormBuilder()
//         ->add('id', HiddenType::class)
//         ->getForm();

//     $deleteDishForm->handleRequest($request);
    
//     if ($deleteDishForm->isSubmitted() && $deleteDishForm->isValid()) {

//         $data = $deleteDishForm->getData();
//         $dish = $entityManager->getRepository(Dish::class)->find($data['id']);
//         $entityManager->remove($dish);
//         $entityManager->flush();

//         return $this->redirectToRoute('admin');
//     }

//     $starterForm = $this->createForm(StarterType::class);
//     $starterForm->handleRequest($request);

//     if ($starterForm->isSubmitted() && $starterForm->isValid()) {
//         $starter = $starterForm->getData();
//         $entityManager->persist($starter);
//         $entityManager->flush();
//         return $this->redirectToRoute('admin');
//     }

//     $deleteStarterForm = $this->createFormBuilder()
//         ->add('id', HiddenType::class)
//         ->getForm();

//     $deleteStarterForm->handleRequest($request);
//     if ($deleteStarterForm->isSubmitted() && $deleteStarterForm->isValid()) {

//         $data = $deleteStarterForm->getData();
//         $starter = $entityManager->getRepository(Starter::class)->find($data['id']);
//         $entityManager->remove($starter);
//         $entityManager->flush();

//         return $this->redirectToRoute('admin');
//     }

//     $cellarForm = $this->createForm(CellarType::class);
//     $cellarForm->handleRequest($request);

//     if ($cellarForm->isSubmitted() && $cellarForm->isValid()) {
//         $cellar = $cellarForm->getData();
//         $entityManager->persist($cellar);
//         $entityManager->flush();
//         return $this->redirectToRoute('admin');
//     }

//     $deleteCellarForm = $this->createFormBuilder()
//         ->add('id', HiddenType::class)
//         ->getForm();

//     $deleteCellarForm->handleRequest($request);
//     if ($deleteCellarForm->isSubmitted() && $deleteCellarForm->isValid()) {

//         $data = $deleteCellarForm->getData();
//         $cellar = $entityManager->getRepository(Cellar::class)->find($data['id']);
//         $entityManager->remove($cellar);
//         $entityManager->flush();

//         return $this->redirectToRoute('admin');
//     }

//     $drinkForm = $this->createForm(DrinkType::class);
//     $drinkForm->handleRequest($request);

//     if ($drinkForm->isSubmitted() && $drinkForm->isValid()) {
//         $drink = $drinkForm->getData();
//         $entityManager->persist($drink);
//         $entityManager->flush();
//         return $this->redirectToRoute('admin');
//     }
    
//     $deleteDrinkForm = $this->createFormBuilder()
//         ->add('id', HiddenType::class)
//         ->getForm();
    
//     $deleteDrinkForm->handleRequest($request);
//     if ($deleteDrinkForm->isSubmitted() && $deleteDrinkForm->isValid()) {
    
//         $data = $deleteDrinkForm->getData();
//         $drink = $entityManager->getRepository(Drink::class)->find($data['id']);
//         $entityManager->remove($drink);
//         $entityManager->flush();
    
//         return $this->redirectToRoute('admin');
//     }
    
//     return $this->render('Admin/admin.html.twig', [
//         'dish' => $dishes,
//         'desserts' => $desserts,
//         'starters' => $starters,
//         'cellars' => $cellars,
//         'drinks' => $drinks,
//         'dish_form' => $dishForm->createView(),
//         'delete_dish_form' => $deleteDishForm->createView(),
//         'starter_form' => $starterForm->createView(),
//         'delete_starter_form' => $deleteStarterForm->createView(),
//         'cellar_form' => $cellarForm->createView(),
//         'delete_cellar_form' => $deleteCellarForm->createView(),
//         'drink_form' => $drinkForm->createView(),
//         'delete_drink_form' => $deleteDrinkForm->createView(),
//     ]);
// }