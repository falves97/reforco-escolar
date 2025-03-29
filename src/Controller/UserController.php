<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserSettingsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/user')]
final class UserController extends AbstractController
{
    #[Route('/profile/{username}', name: 'app_user_profile', methods: ['GET'])]
    public function profile(User $user): Response
    {
        return $this->render('/user/profile.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/settings', name: 'app_user_settings')]
    public function settings(Request $request, EntityManagerInterface $entityManager): Response
    {
        try {
            /** @var User $user */
            $user = $this->getUser();
            $settingsForm = $this->createForm(UserSettingsType::class, $user);

            $settingsForm->handleRequest($request);
            if ($settingsForm->isSubmitted() && $settingsForm->isValid()) {
                $entityManager->persist($user);
                $entityManager->flush();

                $this->addFlash('success', 'Suas configurações foram atualizadas.');

                return $this->redirectToRoute('app_user_settings');
            }
        } catch (\Exception $exception) {
            $this->addFlash('error', 'Erro ao atualizar o seu perfil.');
        }

        return $this->render('/user/settings.html.twig', [
            'settingsForm' => $settingsForm,
        ]);
    }
}
