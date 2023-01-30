<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/galeryManager", name="admin_galeryManager")
 */
class GaleryManagerController extends AbstractController
{
    /**
     * @Route("/", name="admin_galeryManager_index", methods={"GET"})
     */
    public function galeryManager() : Response
    {
        return $this -> render('Admin/galeryManager.html.twig');
    }
}