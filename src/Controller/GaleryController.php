<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GaleryController extends AbstractController
{
    #[Route('/galery', name: 'app_galery')]
    public function galery(): Response
    {
        return $this->render('Galery/galery.html.twig', [
            'controller_name' => 'GaleryController',
        ]);
    }
}
