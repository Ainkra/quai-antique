<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\RegisterType;
use App\Entity\Customer;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class RegisterController extends AbstractController
{
    // Register route
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, ManagerRegistry $doctrine, UserPasswordHasherInterface $passwordHasher, SessionInterface $session): Response
    {
        // We create a new customer
        $user = new Customer();
        $form = $this->createForm(RegisterType::class);
        $form->handleRequest($request); // Handle request
    
        // Verify if form is valid and submited
        if ($form->isSubmitted() && $form->isValid()) {

            $email = $form->get('email')->getData(); // Get email data
            $formData = $form->getData(); // get
            $entityManager = $doctrine->getManager();
            $existingUser = $entityManager->getRepository(Customer::class)->findBy(['email' => $email]);
            $password = $form->get('password')->getData();
            $confirmPassword = $form->get('confirm')->getData();
            
            // If password is not equal at password confirmation
            if ($password !== $confirmPassword) {
                $message = 'Les mots de passe ne sont pas identiques.';
                $messageType = 'error';
    
                return $this->render('Register/register.html.twig', [
                    'register' => $form->createView(),
                    'message' => $message,
                    'messageType' => $messageType
                ]);
            }
    
            // If user email is already used
            if ($existingUser) {
                $message = 'Email déjà utilisé, veuillez en utiliser un autre.';
                $messageType = 'error';
    
                return $this->render('Register/register.html.twig', [
                    'register' => $form->createView(),
                    'message' => $message,
                    'messageType' => $messageType
                ]);
            }

            // hashing password
            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $formData['password']
            );
            
            // Send data at 
            $user->setPassword($hashedPassword);
            $user->setEmail($formData['email']);
            $user->setGuestNumber($formData['guestNumber']);
            $user->setAllergies($formData['allergies']);
            $entityManager->persist($user);
            $entityManager->flush();
    

            // create and set cookie
            $response = new Response();
            $cookieData = [
                'email' => $user->getEmail(),
                'guestNumber' => $user->getGuestNumber(),
                'allergies' => $user->getAllergies(),
            ];

            $cookieValue = json_encode($cookieData);
            $response->headers->setCookie(
                new Cookie(
                    'user_data',
                    $cookieValue,
                    time() + 3600 * 24 * 7 // expire after 1 week
                )
            );
            
            $allergies = $user->getAllergies();
            $guestNumber = $user->getGuestNumber();
            $session->set('allergies', $allergies);
            $session->set('guestNumber', $guestNumber);

            $message = 'Vous avez bien été enregistré(e) !';
            $messageType = 'success';
    
            $form = $this->createForm(RegisterType::class);
            $content = $this->renderView('Register/register.html.twig', [
                'register' => $form->createView(),
                'message' => $message,
                'messageType' => $messageType
            ]);

            $response->setContent($content);

            return $response;
        }
        return $this->render('Register/register.html.twig', [
            'register' => $form->createView()
        ]);
    }
}


