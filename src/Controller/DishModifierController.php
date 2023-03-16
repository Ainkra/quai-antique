<?php

namespace App\Controller;

use App\Entity\Starter;
use App\Form\StarterType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DishModifierController extends AbstractController
{
    #[Route('admin/dishModifier', name: 'admin_dishModifier')]
    public function dishModifier(Request $request, ManagerRegistry $doctrine, Starter $starter): Response
    {

        $form = $this->createForm(StarterType::class, $starter);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $entityManager = $doctrine->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('admin_dishModifier');
        }

        return $this->render('Admin/dishModifier.html.twig', [
            'form' => $form->createView(),
            'starter' => $starter
        ]);
    }
}
