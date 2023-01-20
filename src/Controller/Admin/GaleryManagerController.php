<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class GaleryManagerController extends AbstractController
{
    public function galeryManager() : Response
    {
        return $this -> render('galeryManager.html.twig');
    }
}