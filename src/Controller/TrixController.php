<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/trix')]
final class TrixController extends AbstractController
{
    #[Route('/upload', name: 'app_trix_upload', methods: ['POST'])]
    public function upload(Request $request): Response
    {
        dump($request->files->get('file'));

        return new Response(status: Response::HTTP_NO_CONTENT);
    }
}
