<?php

namespace App\Controller;

use App\Entity\Desserts;
use App\Entity\Starter;
use App\Entity\Dish;
use App\Entity\Drink;
use App\Entity\Cellar;
use App\Entity\Aperitif;
use App\Form\StarterType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class CardController extends AbstractController
{
    #[Route('/', name: 'app_card')]
    public function card(): Response
    {
        return $this->render('Card/card.html.twig', [
            'controller_name' => 'CardController',
        ]);
    }

    public function getEntities(string $entityClass, ManagerRegistry $doctrine): array
    {
        $repository = $doctrine->getManager()->getRepository($entityClass);
        return $repository->findAll();
    }

    #[Route('/', name: 'app_card')]
    public function cardAdder(ManagerRegistry $doctrine): Response
    {
         // get entities
        $starter = $this->getEntities(Starter::class, $doctrine);
        $aperitif = $this->getEntities(Aperitif::class, $doctrine);
        $cellar = $this->getEntities(Cellar::class, $doctrine);
        $desserts = $this->getEntities(Desserts::class, $doctrine);
        $dish = $this->getEntities(Dish::class, $doctrine);
        $drink = $this->getEntities(Drink::class, $doctrine);

        return $this->render('Card/card.html.twig', [
            'starter' => $starter,
            'aperitif' => $aperitif,
            'cellar' => $cellar,
            'desserts' => $desserts,
            'dish' => $dish,
            'drink' => $drink
        ]);
    }

//###########################################################
//                      DELETE SYSTEM
//###########################################################
    #[Route('/starter/delete-all', name: 'starter_delete_all')]
    public function deleteAllStarters(EntityManagerInterface $entityManager): Response
    {
        $entityManager->createQuery('DELETE FROM App\Entity\Starter')->execute();
    
        return $this->redirectToRoute('admin');
    }

    #[Route('/dessert/delete-all', name: 'dessert_delete_all')]
    public function deleteAllDessert(EntityManagerInterface $entityManager): Response
    {
        $entityManager->createQuery('DELETE FROM App\Entity\Desserts')->execute();
    
        return $this->redirectToRoute('admin');
    }

    #[Route('/drink/delete-all', name: 'drink_delete_all')]
    public function deleteAllDrink(EntityManagerInterface $entityManager): Response
    {
        $entityManager->createQuery('DELETE FROM App\Entity\Drink')->execute();
    
        return $this->redirectToRoute('admin');
    }

    #[Route('/dish/delete-all', name: 'dish_delete_all')]
    public function deleteAllDish(EntityManagerInterface $entityManager): Response
    {
        $entityManager->createQuery('DELETE FROM App\Entity\Dish')->execute();
    
        return $this->redirectToRoute('admin');
    }

    #[Route('/aperitif/delete-all', name: 'aperitif_delete_all')]
    public function deleteAllAperitif(EntityManagerInterface $entityManager): Response
    {
        $entityManager->createQuery('DELETE FROM App\Entity\Aperitif')->execute();
    
        return $this->redirectToRoute('admin');
    }

    #[Route('/cellar/delete-all', name: 'cellar_delete_all')]
    public function deleteAllCellar(EntityManagerInterface $entityManager): Response
    {
        $entityManager->createQuery('DELETE FROM App\Entity\Cellar')->execute();
    
        return $this->redirectToRoute('admin');
    }

}