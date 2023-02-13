<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\RegisterType;

class RegisterController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function registerRender(): Response
    {
        $form = $this->createForm(RegisterType::class);

        return $this->render('Register/register.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
