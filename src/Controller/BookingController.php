<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Form\BookingType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookingController extends AbstractController
{
    
    #[Route('/booking', name: 'app_booking')]
    public function booking(Request $request, ManagerRegistry $doctrine): Response
    {
        $user = $this->getUser();

        $form = $this->createForm(BookingType::class);
        $form->handleRequest($request); // Handle request        
        $bookingTime = $form['bookingTime']->getData();

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();

            $booking = new Booking();
            $booking->setName($form['name']->getData()); // Get name data
            $booking->setGuestNumber($form['guestNumber']->getData());
            $booking->setDate($form['date']->getData());
            $booking->setBookingTime(new \DateTimeImmutable($bookingTime));
            $booking->setAllergies($form['allergies']->getData());

            $entityManager->persist($booking);
            $entityManager->flush();

            $message = 'Votre réservation est bien envoyée !';
            $messageType = 'success';

            $form = $this->createForm(BookingType::class);

            return $this->render('Booking/booking.html.twig', [
                'booking' => $form->createView(),
                'message' => $message,
                'messageType' => $messageType
            ]);
        } else if ($form->isSubmitted()) {
            $errors = array();
            
            // Get the error messages for each field
            foreach ($form->getErrors(true) as $error) {
                if (!isset($errors[$error->getOrigin()->getName()])) {
                    $errors[$error->getOrigin()->getName()] = array();
                }
                $errors[$error->getOrigin()->getName()][] = $error->getMessage();
            }

            $form = $this->createForm(BookingType::class, $user);

            return $this->render('Booking/booking.html.twig', [
                'booking' => $form->createView(),
                'errors' => $errors
            ]);
        }

        

        return $this->render('Booking/booking.html.twig', [
            'booking' => $form->createView()
        ]);
    }
}