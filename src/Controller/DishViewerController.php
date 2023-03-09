<?php

namespace App\Controller;

use App\Entity\Aperitif;
use App\Entity\Cellar;
use App\Entity\Desserts;
use App\Entity\Drink;
use App\Entity\Starter;
use App\Entity\Dish;
use App\Repository\StarterRepository;
use App\Repository\AperitifRepository;
use App\Repository\DessertsRepository;
use App\Repository\DishRepository;
use App\Repository\DrinkRepository;
use App\Repository\CellarRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DishViewerController extends AbstractController
{

    #[Route('admin/viewer', name: 'admin_viewer')]
    public function showArticles(
            StarterRepository $starterRepository,
            AperitifRepository $aperitifRepository,
            DessertsRepository $dessertsRepository,
            DishRepository $dishRepository,
            DrinkRepository $drinkRepository,
            CellarRepository $cellarRepository
        ): Response
    {
        // Get entities
        $starters = $starterRepository->findAll();
        $desserts = $dessertsRepository->findAll();
        $dishes = $dishRepository->findAll();
        $drinks = $drinkRepository->findAll();
        $cellars = $cellarRepository->findAll();
        $aperitifs = $aperitifRepository->findAll();

        // Display entities
        return $this->render('Admin/viewer.html.twig', [
            "starters" => $starters,
            "desserts" => $desserts,
            "dishes" => $dishes,
            "drinks" => $drinks,
            "cellars" => $cellars,
            "aperitifs" => $aperitifs,
        ]);
    }

    #[Route('admin/viewer/delete/{type}/{id}', name: 'admin_viewer_delete')]
    public function deleteItem(
        string $type,
        int $id,
        ManagerRegistry $doctrine
    ): Response
    {
        // Determine which entity class to use based on $type
        $entityClass = 'App\\Entity\\' . ucfirst($type);

        // Get the entity object
        $item = $doctrine->getRepository($entityClass)->find($id);

        // If the item does not exist, redirect to the viewer page
        if (!$item) {
            return $this->redirectToRoute('admin_viewer');
        }

        // Delete the item from the database
        $entityManager = $doctrine->getManager();
        $entityManager->remove($item);
        $entityManager->flush();

        // Redirect the user back to the viewer page
        return $this->redirectToRoute('admin_viewer');
    }

    // #[Route('admin/viewer/delete/starter/{id}', name: 'admin_viewer_delete_starter')]
    // public function deleteStarter(
    //     Starter $starter,
    //     ManagerRegistry $doctrine
    // ): Response
    // {
    //     // Delete the dish from the database
    //     $entityManager = $doctrine->getManager();
    //     $entityManager->remove($starter);
    //     $entityManager->flush();

    //     // Redirect the user back to the viewer page
    //     return $this->redirectToRoute('admin_viewer');
    // }

    // #[Route('admin/viewer/delete/desserts/{id}', name: 'admin_viewer_delete_desserts')]
    // public function deleteDessert(
    //     Desserts $desserts,
    //     ManagerRegistry $doctrine
    // ): Response
    // {
    //     // Delete the dish from the database
    //     $entityManager = $doctrine->getManager();
    //     $entityManager->remove($desserts);
    //     $entityManager->flush();

    //     // Redirect the user back to the viewer page
    //     return $this->redirectToRoute('admin_viewer');
    // }
}


