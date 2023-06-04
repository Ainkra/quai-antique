<?php

namespace App\Controller\Galery;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class GaleryMenuController extends AbstractController
{
    #[Route('/admin/galeryManager', name: 'admin_galeryManager')]
    public function galeryMenu(): Response
    {
        return $this->render('Admin/galeryManager.html.twig', [
            'controller_name' => 'GaleryMenuController',
        ]);
    }
}
