<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class CardManagerController extends AbstractController
{
    public function cardManager() : Response
    {
        return $this -> render('Admin/cardManager.html.twig');
    }
}