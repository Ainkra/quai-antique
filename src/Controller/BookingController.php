<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class BookingController extends AbstractController
{

    public function booking() : Response
    {
        $userFirstName = ["test"];

        return $this -> render('booking.html.twig', [
            'user_first_name' => $userFirstName,
        ]);
    }
}