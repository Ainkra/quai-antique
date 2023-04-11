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

class CardController extends AbstractController
{
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
}