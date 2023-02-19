<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\SecurityBundle\Security;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'admin')]
    #[IsGranted('ROLE_ADMIN')]
    public function adminLogin(Request $request, AuthenticationUtils $authenticationUtils, Security $security) : Response
    {
        if ($security->getUser()) {
            return $this->render('Admin/admin.html.twig', [
                'controller_name' => 'GaleryController',
            ]);
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

    #[Route('/admin/cardManager', name: 'admin_cardManager')]
    #[IsGranted('ROLE_ADMIN')]
    public function cardManager(Request $request, AuthenticationUtils $authenticationUtils, Security $security) : Response
    {
        if ($security->getUser()) {
            return $this->render('Admin/admin.html.twig', [
                'controller_name' => 'GaleryController',
            ]);
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
}
