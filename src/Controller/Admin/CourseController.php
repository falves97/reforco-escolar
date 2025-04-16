<?php

namespace App\Controller\Admin;

use App\Entity\Course;
use App\Form\CourseType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/course')]
final class CourseController extends AbstractController
{
    #[Route('/', name: 'app_admin_course')]
    public function index(): Response
    {
        return $this->render('admin/course/index.html.twig');
    }

    #[Route('/create', name: 'app_admin_course_create')]
    public function create(Request $request): Response
    {
        $course = new Course();
        $form = $this->createForm(CourseType::class, $course);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            return $this->redirect('app_admin_course');
        }

        return $this->render('admin/course/create.html.twig', [
            'form' => $form,
        ]);
    }
}
