<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class BookingController extends AbstractController
{

    public function booking() : Response
    {
        return $this -> render('booking.html.twig');
    }
}