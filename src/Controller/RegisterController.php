<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\RegisterType;
use App\Entity\Customer;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
// use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class RegisterController extends AbstractController
{
    // register route
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, ManagerRegistry $doctrine, UserPasswordHasherInterface $passwordHasher) : Response  
    {
        $user = new Customer(); 
        $form = $this->createForm(RegisterType::class);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $email = $form->get('email')->getData();
            $formData = $form->getData();
            $entityManager = $doctrine->getManager();
            $existingUser = $entityManager->getRepository(Customer::class)->findBy(['email' => $email]);
            $password = $form->get('password')->getData();
            $confirmPassword = $form->get('confirm')->getData();


            if ($password !== $confirmPassword) {
                $message = 'Les mots de passe ne sont pas identiques.';
                $messageType = 'error';
    
                return $this->render('Register/register.html.twig', [
                    'register' => $form->createView(),
                    'message' => $message,
                    'messageType' => $messageType
                ]);
            }
    
            if ($existingUser) {
                $message = 'Email déjà utilisé, veuillez en utiliser un autre.';
                $messageType = 'error';
    
                return $this->render('Register/register.html.twig', [
                    'register' => $form->createView(),
                    'message' => $message,
                    'messageType' => $messageType
                ]);
            }

            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $formData['password']
            );
    
            $user->setPassword($hashedPassword);
            $user->setEmail($formData['email']);
            $user->setGuestNumber($formData['guestNumber']);
            $user->setAllergies($formData['allergies']);
            $entityManager->persist($user);
            $entityManager->flush();
            $message = 'Vous avez bien été enregistré(e) !';
            $messageType = 'success';
    
            $form = $this->createForm(RegisterType::class);
            return $this->render('Register/register.html.twig', [
                'register' => $form->createView(),
                'message' => $message,
                'messageType' => $messageType
            ]);
        }
    
        // Si le formulaire n'est pas encore soumis ou est invalide, on renvoie une réponse avec le formulaire
        return $this->render('Register/register.html.twig', [
            'register' => $form->createView()
        ]);
    }
}