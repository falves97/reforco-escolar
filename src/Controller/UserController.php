<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/user')]
final class UserController extends AbstractController
{
    #[Route('/{username}', name: 'app_user_profile', methods: ['GET'])]
    public function profile(User $user): Response
    {
        return $this->render('/user/profile.html.twig', [
            'user' => $user,
        ]);
    }
}
