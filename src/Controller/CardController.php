<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CardController extends AbstractController
{
    #[Route('/', name: 'app_card')]
    public function card(): Response
    {
        return $this->render('Card/card.html.twig', [
            'controller_name' => 'CardController',
        ]);
    }
}
