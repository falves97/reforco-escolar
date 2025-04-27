<?php

namespace App\Controller\Admin;

use App\Entity\Course;
use App\Form\CourseType;
use App\Repository\CourseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Gedmo\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/course')]
final class CourseController extends AbstractController
{
    #[Route('/', name: 'app_admin_course', methods: ['GET'])]
    public function index(Request $request, CourseRepository $courseRepository): Response
    {
        $page = $request->get('page', 1);

        $courses = $courseRepository->getCoursesPaginator();
        $courses->setMaxPerPage(10);
        $courses->setCurrentPage($page);

        return $this->render('admin/course/index.html.twig', [
            'courses' => $courses,
            'title' => 'Disciplinas',
        ]);
    }

    #[Route('/create', name: 'app_admin_course_create', methods: ['GET', 'POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $course = new Course();
        $form = $this->createForm(CourseType::class, $course);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($course);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_course');
        }

        return $this->render('admin/course/form.html.twig', [
            'form' => $form,
            'title' => 'Criar Disciplina',
        ]);
    }

    #[Route('/{id}/update', name: 'app_admin_course_update', methods: ['GET', 'POST'])]
    public function update(Request $request, CourseRepository $courseRepository, EntityManagerInterface $entityManager): Response
    {
        $course = $courseRepository->findOneBy(['id' => $request->get('id')]);
        $form = $this->createForm(CourseType::class, $course);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($course);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_course');
        }

        return $this->render('admin/course/form.html.twig', [
            'form' => $form,
            'title' => 'Editar Disciplina',
        ]);
    }

    #[Route('/{id}/show', name: 'app_admin_course_show', methods: ['GET'])]
    public function show(Request $request, CourseRepository $courseRepository): Response
    {
        $course = $courseRepository->findOneBy(['id' => $request->get('id')]);

        return $this->render('admin/course/show.html.twig', [
            'course' => $course,
            'title' => 'Detalhes do Disciplina',
        ]);
    }

    #[Route('/{id}/delete', name: 'app_admin_course_delete', methods: ['POST'])]
    public function delete(Request $request, CourseRepository $courseRepository, EntityManagerInterface $entityManager): Response
    {
        try {
            $course = $courseRepository->findOneBy(['id' => $request->get('id')]);

            if ($course) {
                $entityManager->remove($course);
                $entityManager->flush();

                $this->addFlash('success', 'Entidade removida com sucesso');

                return $this->redirectToRoute('app_admin_course');
            }
        } catch (Exception $exception) {
        }

        return $this->json(['message' => 'Erro ao tentar remover a entidade'], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
