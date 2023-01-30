<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/shedulerManager", name="admin_shedulerManager")
 */
class ShedulerManagerController extends AbstractController
{
    /**
     * @Route("/", name="admin_shedulerManager_index", methods={"GET"})
     */
    public function shedulerManager() : Response
    {
        return $this -> render('Admin/shedulerManager.html.twig');
    }
}