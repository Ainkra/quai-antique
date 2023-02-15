<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\ConnectionType;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\Customer;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ConnectionController extends AbstractController
{
    #[Route('/connection', name: 'app_connection')]
    public function connection(Request $request, ManagerRegistry $doctri): Response
    {
        $form = $this->createForm(ConnectionType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $connection = $form->getData();
            $user = $this->getUserByUsernameOrEmail($connection['username']);

            if (!$user) {
                // handle error
            }

            $success = $this->get('security.authentication.manager')
                ->loginUser('main', $user);

            if ($success) {
                return $this->redirectToRoute('homepage');
            }

            // handle error
        }
        return $this->render('Connection/connection.html.twig', [
            'connection' => $form->createView(),
        ]);
    }

    private function getUserByUsernameOrEmail(string $usernameOrEmail)
    {
        return $this->getManager()->getRepository(User::class)
            ->loadUserByUsername($usernameOrEmail);
    }
}
