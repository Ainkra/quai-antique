<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{
    public function index() : Response
    {
        return $this -> render('home.html.twig');
    }

    public function maintenance() : Response
    {
        return $this -> render('maintenance.html.twig');
    }
}