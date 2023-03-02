<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
class ConnectionController extends AbstractController
{ 
    #[Route('/connection', name: 'app_connection')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $customer = $this->getUser();
        
        // Récupération de la dernière erreur d'authentification s'il y en a une
        $error = $authenticationUtils->getLastAuthenticationError();

        // Récupération du dernier nom d'utilisateur utilisé
        $lastUsername = $authenticationUtils->getLastUsername();

        // Affichage du formulaire de connexion
        return $this->render('Connection/connection.html.twig', [
            'customer' => $customer,
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }
}
