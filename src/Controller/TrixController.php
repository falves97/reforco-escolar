<?php

namespace App\Controller;

use App\Entity\ImageFile;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

#[Route('/trix')]
final class TrixController extends AbstractController
{
    #[Route('/upload', name: 'app_trix_upload', methods: ['POST'])]
    public function upload(Request $request, EntityManagerInterface $entityManager, UploaderHelper $uploaderHelper): Response
    {
        try {
            $image = new ImageFile();
            dump($request);
            $image->setFile($request->files->get('file'));

            $entityManager->persist($image);
            $entityManager->flush();
        } catch (\Exception $exception) {
            return new JsonResponse(['message' => $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new JsonResponse(['url' => $uploaderHelper->asset($image)], Response::HTTP_CREATED);
    }
}
