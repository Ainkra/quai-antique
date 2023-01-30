<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/cardManager", name="admin_cardManager")
 */
class CardManagerController extends AbstractController
{
    /**
     * @Route("/", name="admin_cardManager_index", methods={"GET"})
     */
    public function cardManager() : Response
    {
        return $this -> render('Admin/cardManager.html.twig');
    }
}