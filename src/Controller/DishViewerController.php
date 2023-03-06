<?php

namespace App\Controller;

use App\Repository\StarterRepository;
use App\Repository\AperitifRepository;
use App\Repository\DessertsRepository;
use App\Repository\DishRepository;
use App\Repository\DrinkRepository;
use App\Repository\CellarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DishViewerController extends AbstractController
{

    #[Route('admin/viewer', name: 'admin_viewer')]
    public function showStarters(
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
}
