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
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\SecurityBundle\Security;
use Doctrine\Persistence\ManagerRegistry;


class AdminController extends AbstractController
{

//############################################################
//                      ADMIN ROUTING
//############################################################

    //IsGranted allow access only at user who's have admin role
    #[Route('/admin', name: 'admin')]
    #[IsGranted('ROLE_ADMIN')]
    public function adminLogin(AuthenticationUtils $authenticationUtils, Security $security) : Response
    {
        if ($security->getUser()) {
            return $this->render('Admin/admin.html.twig');
        }

        // Get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // Last email entered by the user
        $lastEmail = $authenticationUtils->getLastUsername();

        // Render the login form
        return $this->render('Admin/admin.html.twig', [
            'last_email' => $lastEmail,
            'error' => $error
        ]);
    }

    // Render bookingManager
    #[Route('/admin/bookingManager', name: 'admin_bookingManager')]
    #[IsGranted('ROLE_ADMIN')]
    public function bookingManager()
    {
        return $this->render('Admin/bookingManager.html.twig');
    }

    // Render galeryManager
    #[Route('/admin/galeryManager', name: 'admin_galeryManager')]
    #[IsGranted('ROLE_ADMIN')]
    public function galeryManager()
    {
        return $this->render('Admin/galeryManager.html.twig');
    }

    // Render shedulerManager
    #[Route('/admin/shedulerManager', name: 'admin_shedulerManager')]
    #[IsGranted('ROLE_ADMIN')]
    public function shedulerManager()
    {
        return $this->render('Admin/shedulerManager.html.twig');
    }


//############################################################
//                      Form Management
//############################################################
    #[Route('/admin', name: 'admin')]
    #[IsGranted('ROLE_ADMIN')]
    public function cardFormManager(Request $request, ManagerRegistry $doctrine): Response
    {
        // Declare new Entity
        $starter = new Starter();
        $dish = new Dish();
        $dessert = new Desserts();
        $cellar = new Cellar();
        $aperitif = new Aperitif();
        $drink = new Drink();
        
        // Form creation
        $drinkForm = $this->createForm(DrinkType::class, $drink);
        $drinkForm->handleRequest($request);

        $aperitifForm = $this->createForm(AperitifType::class, $aperitif);
        $aperitifForm->handleRequest($request);

        $cellarForm = $this->createForm(CellarType::class, $cellar);
        $cellarForm->handleRequest($request);

        $dessertForm = $this->createForm(DessertType::class, $dessert);
        $dessertForm->handleRequest($request);

        $starterForm = $this->createForm(StarterType::class, $starter);
        $starterForm->handleRequest($request);

        $dishForm = $this->createForm(DishType::class, $dish);
        $dishForm->handleRequest($request);

        // Send data who's submitted, into database
        if ($dishForm->isSubmitted() && $dishForm->isValid()) {
            $entityManager = $doctrine->getManager();
            $entityManager->persist($dish);
            $entityManager->flush();

            return $this->redirectToRoute('admin');
        }

        if ($starterForm->isSubmitted() && $starterForm->isValid()) {
            $entityManager = $doctrine->getManager();
            $entityManager->persist($starter);
            $entityManager->flush();

            return $this->redirectToRoute('admin');
        }

        if ($dessertForm->isSubmitted() && $dessertForm->isValid()) {
            $entityManager = $doctrine->getManager();
            $entityManager->persist($dessert);
            $entityManager->flush();

            return $this->redirectToRoute('admin');
        }

        if ($cellarForm->isSubmitted() && $cellarForm->isValid()) {
            $entityManager = $doctrine->getManager();
            $entityManager->persist($cellar);
            $entityManager->flush();

            return $this->redirectToRoute('admin');
        }

        if ($aperitifForm->isSubmitted() && $aperitifForm->isValid()) {
            $entityManager = $doctrine->getManager();
            $entityManager->persist($aperitif);
            $entityManager->flush();

            return $this->redirectToRoute('admin');
        }

        if ($drinkForm->isSubmitted() && $drinkForm->isValid()) {
            $entityManager = $doctrine->getManager();
            $entityManager->persist($drink);
            $entityManager->flush();

            return $this->redirectToRoute('admin');
        }

        // Display different forms
        return $this->render('Admin/admin.html.twig', [
            'dish' => $dishForm->createView(),
            'starter' => $starterForm->createView(),
            'dessert' => $dessertForm->createView(),
            'cellar' => $cellarForm->createView(),
            'aperitif' => $aperitifForm->createView(),
            'drink' => $drinkForm->createView()
        ]);
    }
}