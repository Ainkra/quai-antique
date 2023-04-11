<?php

namespace App\Controller;

use App\Entity\Dish;
use App\Entity\Desserts;
use App\Entity\Drink;
use App\Entity\Cellar;
use App\Entity\Starter;
use App\Entity\Aperitif;
use App\Form\DishType;
use App\Form\StarterType;
use App\Form\DessertType;
use App\Form\AperitifType;
use App\Form\CellarType;
use App\Form\DrinkType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DishAdderController extends AbstractController
{
    
    //############################################################
    //                      Form Management
    //############################################################
    #[Route('/admin/cardManager', name: 'admin_cardManager')]
    #[IsGranted('ROLE_ADMIN')]
    public function dishAdder(Request $request, ManagerRegistry $doctrine): Response
    {
        // Declare new Entity
        $starter = new Starter();
        $dish = new Dish();
        $dessert = new Desserts();
        $cellar = new Cellar();
        $aperitif = new Aperitif();
        $drink = new Drink();
        
        // Form creation
        $starterForm = $this->createForm(StarterType::class, $starter);
        $starterForm->handleRequest($request);

        $drinkForm = $this->createForm(DrinkType::class, $drink);
        $drinkForm->handleRequest($request);

        $aperitifForm = $this->createForm(AperitifType::class, $aperitif);
        $aperitifForm->handleRequest($request);

        $cellarForm = $this->createForm(CellarType::class, $cellar);
        $cellarForm->handleRequest($request);

        $dessertForm = $this->createForm(DessertType::class, $dessert);
        $dessertForm->handleRequest($request);

        $dishForm = $this->createForm(DishType::class, $dish);
        $dishForm->handleRequest($request);

        // Send data who's submitted, into database
        if ($dishForm->isSubmitted() && $dishForm->isValid()) {
            $entityManager = $doctrine->getManager();
            $entityManager->persist($dish);
            $entityManager->flush();

            return $this->redirectToRoute('admin_cardManager');
        }

        if ($starterForm->isSubmitted() && $starterForm->isValid()) {
            $entityManager = $doctrine->getManager();
            $entityManager->persist($starter);
            $entityManager->flush();

            return $this->redirectToRoute('admin_cardManager');
        }

        if ($dessertForm->isSubmitted() && $dessertForm->isValid()) {
            $entityManager = $doctrine->getManager();
            $entityManager->persist($dessert);
            $entityManager->flush();

            return $this->redirectToRoute('admin_cardManager');
        }

        if ($cellarForm->isSubmitted() && $cellarForm->isValid()) {
            $entityManager = $doctrine->getManager();
            $entityManager->persist($cellar);
            $entityManager->flush();

            return $this->redirectToRoute('admin_cardManager');
        }

        if ($aperitifForm->isSubmitted() && $aperitifForm->isValid()) {
            $entityManager = $doctrine->getManager();
            $entityManager->persist($aperitif);
            $entityManager->flush();

            return $this->redirectToRoute('admin_cardManager');
        }

        if ($drinkForm->isSubmitted() && $drinkForm->isValid()) {
            
            $entityManager = $doctrine->getManager();
            $entityManager->persist($drink);
            $entityManager->flush();

            return $this->redirectToRoute('admin_cardManager');
        }

        // Display different forms
        return $this->render('Admin/dishAdder.html.twig', [
            'dish' => $dishForm->createView(),
            'starter' => $starterForm->createView(),
            'dessert' => $dessertForm->createView(),
            'cellar' => $cellarForm->createView(),
            'aperitif' => $aperitifForm->createView(),
            'drink' => $drinkForm->createView()
        ]);
    }
}
