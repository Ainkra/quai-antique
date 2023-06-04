<?php

namespace App\Controller\Galery;

use App\Entity\Image;
use App\Form\ImageType;
use App\Repository\ImageRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageAdderController extends AbstractController
{
    #[Route('/admin/galeryManager/imageAdder', name: 'admin_imageAdder')]
    public function imageAdder(Request $request, ManagerRegistry $doctrine, ImageRepository $imageRepository): Response
    {
        $image = new Image();

        $logsDirectory = 'public/logs/';
        $date = date('Y-m-d H:i:s');

        $imageForm = $this->createForm(ImageType::class, $image);
        $imageForm->handleRequest($request);

        if($imageForm->isSubmitted() && $imageForm->isValid())
        {
            /**
             * @var UploadedFile $file
             */
            $file = $imageForm->get('imageFilename')->getData();
            $description = $imageForm->get('description')->getData();
            
            try {

                $fileName = uniqid().'.'.$file->getClientOriginalExtension();
                $file->move($this->getParameter('upload_directory'), $fileName);

                $existingImage = $imageRepository->findBy(['imageFilename' => $fileName]);
                $existingDescription = $imageRepository->findBy(['description' => $description]);

                if($existingImage || $existingDescription) {
                    $message = 'Cette image/description existe déjà dans votre galerie.';
                    $messageType = 'error';

                    return $this->render('Admin/imageAdder.html.twig', [
                        "image" => $imageForm->createView(),
                        "message" => $message,
                        "messageType" => $messageType
                    ]);

                } else {
                    $image->setImageFilename($fileName);
                    $image->setDescription($description);

                    $entityManager = $doctrine->getManager();
                    $entityManager->persist($image);
                    $entityManager->flush();

                    $message = 'Image envoyée avec succès.'; // notification message
                    $messageType = 'success'; // Used in template for modify css class

                    return $this->render('Admin/imageAdder.html.twig', [
                        "image" => $imageForm->createView(),
                        "message" => $message,
                        "messageType" => $messageType
                    ]);
                }

            } catch (FileException $e) {

                $fileName = $logsDirectory . 'log_'. date('Y-m-d_H-i-s') . '.txt';
                $logMessage = "Date/heure: $date" . PHP_EOL . "Error: " . $e->getMessage() . PHP_EOL;
                
                file_put_contents($fileName, $logMessage, FILE_APPEND);

                $message = 'Un problème est survenu avec votre fichier.<br> Veuillez en choisir un autre';
                $messageType = 'error';

                return $this->render('admin/news_adder/newsAdder.html.twig', [
                    "image" => $imageForm->createView(),
                    "message" => $message,
                    "messageType" => $messageType
                ]);
            }
        }

        return $this->render('Admin/imageAdder.html.twig', [
            "image" => $imageForm->createView(),
        ]);
    }
}
