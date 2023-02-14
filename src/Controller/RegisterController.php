<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\RegisterType;
use App\Entity\Customer;
use Doctrine\ORM\NoResultException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class RegisterController extends AbstractController
{

    public function handleFormSubmission($formData, ManagerRegistry $doctrine, UserPasswordHasherInterface $passwordHasher)
    {
        try {
            // create a new user entity and set its properties
            $user = new Customer();
            $plainTextPassword = $user->getPassword($formData['password']);
            $hashedPassword = $passwordHasher->hashPassword($user, $plainTextPassword);

            $user->setEmail($formData['email']);
            $user->setPassword($hashedPassword);
            $user->setGuestNumber($formData['guestNumber']);
            $user->setAllergies($formData['allergies']);
    
            // persist the user entity to the database
            $entityManager = $doctrine->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

    
        } catch (NoResultException $e) {
            echo $e;
        }
    }

    #[Route('/register', name: 'app_register')]
    public function registerRender(Request $request, ManagerRegistry $doctrine, UserPasswordHasherInterface $passwordHasher): Response
    {
        $form = $this->createForm(RegisterType::class);
        $message = null;
    
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->handleFormSubmission($form->getData(), $doctrine, $passwordHasher);
            $message = 'Le formulaire a été envoyé avec succès';
        }
    
        return $this->render('Register/register.html.twig', [
            'register' => $form->createView(),
            'message' => $message
        ]);
    }
}