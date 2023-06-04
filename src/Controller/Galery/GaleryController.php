<?php

namespace App\Controller\Galery;

use App\Entity\Image;
use App\Repository\ImageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GaleryController extends AbstractController
{
    #[Route('/galery', name: 'app_galery')]
    public function imageDisplayer(ImageRepository $imageRepository): Response
    {
        $images = $imageRepository->findAll();

        return $this->render('Galery/galery.html.twig', [
            'images' => $images,
        ]);
    }
}
