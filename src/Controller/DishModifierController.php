<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DishModifierController extends AbstractController
{
    #[Route('/dish/modifier', name: 'app_dish_modifier')]
    public function dishModifier(): Response
    {
        return $this->render('Admin/dishModifier.html.twig', [
            'controller_name' => 'DishModifierController',
        ]);
    }
}
