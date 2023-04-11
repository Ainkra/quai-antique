<?php

namespace App\Controller;

use App\Entity\Aperitif;
use App\Entity\Dish;
use App\Entity\Drink;
use App\Entity\Desserts;
use App\Entity\Starter;
use App\Entity\Cellar;
use App\Form\StarterType;
use App\Form\DishType;
use App\Form\AperitifType;
use App\Form\CellarType;
use App\Form\DrinkType;
use App\Form\DessertType;
use App\Form\RemainingPlacesType;
use App\Repository\StarterRepository;
use App\Repository\AperitifRepository;
use App\Repository\DishRepository;
use App\Repository\DrinkRepository;
use App\Repository\CellarRepository;
use App\Repository\DessertsRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DishModifierController extends AbstractController
{
    /**
     * Rendering forms and page.
     */
    #[Route('admin/dishModifier', name: 'admin_dishModifier')]
    public function dishDisplayer(
        StarterRepository $starterRepository,
    ) : Response
    {
        $starters = $starterRepository->findAll();

        return $this->render('Admin/dishModifier.html.twig', [
            "starters" => $starters,
        ]);
    }

    /**
     * Permit to get the dish and modify it
     */
    #[Route('admin/dishModifier/{type}/{id}/edit', name: 'admin_dishModifier_edit')]
    public function dishModifier(Request $request, $type, $id, ManagerRegistry $doctrine): Response
    {
        $entityClass = $this->getEntityClass($type);
        $entity = $doctrine->getRepository($entityClass)->find($id);
        
        $formType = $this->getFormType($type);
        $form = $this->createForm($formType, $entity);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();
            $entityManager->persist($entity);
            $entityManager->flush();
    
            return $this->redirectToRoute('admin_dishModifier');
        }
    
        return $this->render('Admin/dishEdit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Permit to get the dish and identify it
     * @param string $type Dish type
     */
    private function getEntityClass($type)
    {
        switch ($type) {
            case 'starter':
                return Starter::class;
            case 'dish':
                return Dish::class;
            case 'drink':
                return Drink::class;
            case 'desserts':
                return Desserts::class;
            case 'aperitif':
                return Aperitif::class;
            case 'cellar':
                return Cellar::class;
        }

        throw new \InvalidArgumentException("Type de plat non valide");
    }

    /**
     * Permit to get the form type
     * @param string $type form type
     */
    private function getFormType(string $type): string
    {
        switch ($type) {
            case 'starter':
                return StarterType::class;
            case 'dish':
                return DishType::class;
            case 'drink':
                return DrinkType::class;
            case 'desserts':
                return DessertType::class;
            case 'aperitif':
                return AperitifType::class;
            case 'cellar':
                return CellarType::class;
            }

        throw new \InvalidArgumentException("Formulaire invalide");
    }
}