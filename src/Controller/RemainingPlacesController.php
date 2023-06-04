<?php

namespace App\Controller;

use App\Entity\RemainingPlaces;
use App\Form\RemainingPlacesType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RemainingPlacesController extends AbstractController
{
    /**
     * Permit to rendering and modify maximum places allowed in the restaurant.
     */
    #[Route('/admin/bookingManager', name: 'admin_bookingManager')]
    public function remainingPlaces(Request $request, ManagerRegistry $doctrine): Response
    {
        $remainingPlaceRepository = $doctrine->getRepository(RemainingPlaces::class);
        $remainingPlaces = $remainingPlaceRepository->findOneBy([]);

        $form = $this->createForm(RemainingPlacesType::class, $remainingPlaces);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // If no remainingPlaces table exists, one is created
            if ($remainingPlaces === null) {
                $remainingPlacesNew = new RemainingPlaces();
                $remainingPlacesNew->setPlaces($form['places']->getData());
                $entityManager = $doctrine->getManager();
                $entityManager->persist($remainingPlacesNew);
                $entityManager->flush();
            // Otherwise, we update the current entity.  
            } else {
                $entityManager = $doctrine->getManager();
                $entityManager->persist($remainingPlaces);
                $entityManager->flush();
            }
            
            $message = "Nombre de places maximum modifié avec succès !";
            return $this->render('Admin/bookingManager.html.twig', [
                'form' => $form,
                'message' => $message
            ]);
        }

        return $this->render('Admin/bookingManager.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
