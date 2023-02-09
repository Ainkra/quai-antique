<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/bookingManager", name="admin_bookingManager")
 */
class BookingManagerController extends AbstractController
{
    /**
     * @Route("/", name="admin_bookingManager_index", methods={"GET"})
     */
    public function bookingManager() : Response
    {
        return $this -> render('Admin/bookingManager.html.twig');
    }
}