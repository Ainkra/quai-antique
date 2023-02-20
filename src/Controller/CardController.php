<?php

namespace App\Controller;

use App\Entity\Desserts;
use App\Entity\Starter;
use App\Entity\Dish;
use App\Entity\Drink;
use App\Entity\Cellar;
use App\Entity\Aperitif;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

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
    public function starter(ManagerRegistry $doctrine): Response
    {
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
}
