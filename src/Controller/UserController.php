<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();

        $user = new User();
        $user->setName('nomUtilisateur');
        $user->setGuestNumber(5);
        $user->setDate(\DateTime::createFromFormat('d-m-Y', '25-12-2001'));
        $user->setBookingTime(\DateTime::createFromFormat('H:i', '12:15'));
        $user->setAllergies("nothing");

        $entityManager->persist($user);
        $entityManager->flush();
    
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
}
