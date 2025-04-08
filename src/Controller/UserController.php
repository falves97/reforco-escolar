<?php

namespace App\Controller;

use App\Entity\AvatarFile;
use App\Entity\User;
use App\Form\UserSettingsType;
use App\Repository\UserRepository;
use App\Services\AvatarService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Vich\UploaderBundle\FileAbstraction\ReplacingFile;

#[Route('/user')]
final class UserController extends AbstractController
{
    #[Route('/profile/{username}', name: 'app_user_profile', methods: ['GET'])]
    public function profile(string $username, UserRepository $userRepository): Response
    {
        $user = $userRepository->findOneBy(['username' => $username]);

        return $this->render('/user/profile.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/settings', name: 'app_user_settings')]
    public function settings(Request $request, EntityManagerInterface $entityManager, AvatarService $avatarService): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $settingsForm = $this->createForm(UserSettingsType::class, $user);
        $avatars = $avatarService->getAllAvatarsImages();

        try {
            $settingsForm->handleRequest($request);
            if ($settingsForm->isSubmitted() && $settingsForm->isValid()) {
                $avatarPath = $settingsForm->get('defaultAvatar')->getData();
                $deleteAvatar = boolval($settingsForm->get('deleteAvatar')->getData());

                if ($avatarPath && $avatarService->exists($avatarPath)) {
                    $avatarPath = $avatarService->makeAbsolute($avatarPath);

                    $deleteAvatarOption = new AvatarFile();
                    $deleteAvatarOption->setFile(new ReplacingFile($avatarPath));
                    $user->setAvatar($deleteAvatarOption);
                } elseif ($deleteAvatar) {
                    $user->setAvatar(null);
                }

                $entityManager->persist($user);
                $entityManager->flush();

                $this->addFlash('success', 'Suas configurações foram atualizadas.');

                return $this->redirectToRoute('app_user_settings');
            }
        } catch (\Exception $exception) {
            $this->addFlash('error', 'Erro ao atualizar o seu perfil.');

            return $this->redirectToRoute('app_user_settings');
        }

        return $this->render('/user/settings.html.twig', [
            'settingsForm' => $settingsForm,
            'avatars' => $avatars,
        ]);
    }
}
