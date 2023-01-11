<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class GaleryController extends AbstractController
{
    public function galery() : Response
    {
        return $this -> render('galery.html.twig');
    }
}