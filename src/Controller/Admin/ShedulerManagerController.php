<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ShedulerManagerController extends AbstractController
{
    public function shedulerManager() : Response
    {
        return $this -> render('shedulerManager.html.twig');
    }
}