<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ShedulerManagerController extends AbstractController
{
    public function shedulerManager() : Response
    {
        return $this -> render('shedulerManager.html.twig');
    }
}