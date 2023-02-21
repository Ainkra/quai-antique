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
    // Booking route 
    #[Route('/booking', name: 'app_booking')]
    public function booking(Request $request, ManagerRegistry $doctrine): Response
    {
        // get user
        $user = $this->getUser();

        // Create form and get data in form.
        $form = $this->createForm(BookingType::class);
        $form->handleRequest($request); // Handle request        
        $bookingTime = $form['bookingTime']->getData();

        
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();

            // Create new booking view
            $booking = new Booking();
            $booking->setName($form['name']->getData()); // Get name data
            $booking->setGuestNumber($form['guestNumber']->getData()); // Get guestNumber data
            $booking->setDate($form['date']->getData()); // Get date data
            $booking->setBookingTime(new \DateTimeImmutable($bookingTime)); // Get hour data
            $booking->setAllergies($form['allergies']->getData()); // Get allergies data

            $entityManager->persist($booking);
            $entityManager->flush(); // send data in data base

            $message = 'Votre réservation est bien envoyée !'; // notification message
            $messageType = 'success'; // Used in template for modify css class

            $form = $this->createForm(BookingType::class); // form creation

             // form display
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