<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Entity\RemainingPlaces;
use App\Repository\RemainingPlacesRepository;
use App\Repository\BookingRepository;
use App\Form\BookingType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class BookingController extends AbstractController
{
    // Booking route 
    #[Route('/booking', name: 'app_booking')]
    public function booking(Request $request, ManagerRegistry $doctrine, EntityManagerInterface $getDoctrine): Response
    {
        // Create form and get data in form.
        $form = $this->createForm(BookingType::class);
        $form->handleRequest($request); // Handle request
        $messageType = '';
        $message = '';
        
        $bookingTime = $form['bookingTime']->getData();
        
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $doctrine->getManager();
            $bookingDate = $form['date']->getData();

            // SELECT COUNT(id) 
            // FROM booking
            // WHERE date = :date;
            $bookingRepository = $getDoctrine->getRepository(Booking::class);
            $bookingNumber = $bookingRepository->createQueryBuilder('e')
                ->select('count(e.id)')
                ->where('e.date = :date')
                ->setParameter('date', $bookingDate)
                ->getQuery()
                ->getSingleScalarResult();

            // SELECT places
            // FROM remaining_places;
            $remainingPlacesRepository = $getDoctrine->getRepository(RemainingPlaces::class);
            $remainingPlaces = $remainingPlacesRepository->createQueryBuilder('p')
                ->select('p.places') 
                ->getQuery() 
                ->getSingleScalarResult();

            if ($bookingNumber >= $remainingPlaces) {
                // Refusez la réservation et renvoyez un message d'erreur à l'utilisateur
                $message = "Aucune table n'est disponible ce jour. Veuillez revenir plus tard.";
                $messageType = 'error';

            } else {
                $booking = new Booking();

                $booking->setName($form['name']->getData()); // Get name data
                $booking->setGuestNumber($form['guestNumber']->getData()); // Get guestNumber data
                $booking->setDate($form['date']->getData()); // Get date data
                $booking->setBookingTime(new \DateTimeImmutable($bookingTime)); // Get hour data
                $booking->setAllergies($form['allergies']->getData()); // Get allergies data

                $entityManager->persist($booking);
                $entityManager->flush(); // send data in data base

                $message = 'Votre réservation est bien envoyée !'; // notification message
                $messageType = 'success'; // css class success

                return $this->redirectToRoute('app_booking');
            }

            return $this->render('Booking/booking.html.twig', [
                'booking' => $form->createView(),
                'message' => $message,
                'messageType' => $messageType
            ]);
        }
        
        $form = $this->createForm(BookingType::class); // form creation

        // form display
        return $this->render('Booking/booking.html.twig', [
            'booking' => $form->createView(),
        ]);
    }

    #[Route('/booking/remainingPlaces', name: 'app_booking_remainingPlaces')]
    public function remainingPlaces(EntityManagerInterface $doctrine): JsonResponse
    {
        // SELECT places
        // FROM remaining_places;
        $remainingPlacesRepository = $doctrine->getRepository(RemainingPlaces::class);
        $remainingPlaces = $remainingPlacesRepository->createQueryBuilder('p')
            ->select('p.places') 
            ->getQuery() 
            ->getSingleScalarResult();

        // SELECT COUNT(id)
        // FROM booking;
        $bookingRepository = $doctrine->getRepository(Booking::class); 
        $bookingNumber = $bookingRepository->createQueryBuilder('e') 
            ->select('count(e.id)') 
            ->getQuery() 
            ->getSingleScalarResult();
    
        return new JsonResponse([
            'bookingNumber' => $bookingNumber,
            'remainingPlaces' => $remainingPlaces
        ]);
    }
}