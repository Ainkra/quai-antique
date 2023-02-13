<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ConnectionController extends AbstractController
{
    #[Route('/connection', name:'connection')]
    public function connection()
    {
        return $this -> render('connection.html.twig');
    }
}