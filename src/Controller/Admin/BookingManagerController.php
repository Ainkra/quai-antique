<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class BookingManagerController extends AbstractController
{
    public function bookingManager() : Response
    {
        return $this -> render('bookingManager.html.twig');
    }
}