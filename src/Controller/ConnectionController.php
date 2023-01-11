<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ConnectionController extends AbstractController
{
    public function connection() : Response
    {
        return $this -> render('connection.html.twig');
    }
}