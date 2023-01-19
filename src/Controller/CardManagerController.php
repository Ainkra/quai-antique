<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class CardManagerController extends AbstractController
{
    public function cardManager() : Response
    {
        return $this -> render('cardManager.html.twig');
    }
}