<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Bundle\SecurityBundle\Security;

class AdminController extends AbstractController
{

//############################################################
//                      ADMIN ROUTING
//############################################################

    //IsGranted allow access only at user who's have admin role
    #[Route('/admin', name: 'admin')]
    #[IsGranted('ROLE_ADMIN')]
    public function adminLogin(AuthenticationUtils $authenticationUtils, Security $security) : Response
    {
        if ($security->getUser()) {
            return $this->render('Admin/admin.html.twig');
        }

        // Get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // Last email entered by the user
        $lastEmail = $authenticationUtils->getLastUsername();

        // Render the login form
        return $this->render('Admin/admin.html.twig', [
            'last_email' => $lastEmail,
            'error' => $error
        ]);
    }

    // Render shedulerManager
    #[Route('/admin/shedulerManager', name: 'admin_shedulerManager')]
    #[IsGranted('ROLE_ADMIN')]
    public function shedulerManager()
    {
        return $this->render('Admin/shedulerManager.html.twig');
    }
}