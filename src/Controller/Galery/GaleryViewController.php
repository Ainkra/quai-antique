<?php

namespace App\Controller\Galery;

use App\Entity\Image;
use App\Repository\ImageRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GaleryViewController extends AbstractController
{
    #[Route('/admin/galeryManager/galeryView', name: 'admin_galeryView')]
    public function galeryView(ImageRepository $imageRepository): Response
    {
        $images = $imageRepository->findAll();

        return $this->render('Admin/galeryView.html.twig', [
            'images' => $images,
        ]);
    }

    #[Route('/admin/galeryManager/galeryView/delete/{id}', name: 'admin_galeryView_delete')]
    public function imageDeleter(int $id, Image $image, ManagerRegistry $doctrine): Response
    {
        $imageFilename = $image->getImageFilename();
        $imageRemove = $doctrine->getRepository(Image::class)->find($id);

        $pathImage = $this->getParameter('upload_directory') . '/' . $imageFilename;

        if(file_exists($pathImage)) {
            unlink($pathImage);
        } 

        if(!$imageRemove) {
            return $this->redirectToRoute('admin_galeryView');
        }

        $entityManager = $doctrine->getManager();
        $entityManager->remove($image);
        $entityManager->flush();

        return $this->redirectToRoute('admin_galeryView');
    }
}
