<?php

namespace App\Controller;

use App\Entity\Student;
use App\Form\StudentType;

use App\Repository\StudentRepository;
use App\Security\UserAuthenticatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/student')]
class StudentController extends AbstractController
{
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/index', name: 'app_student_index')]
    public function bookIndex (StudentRepository $studentRepository) {
        $students = $studentRepository->sortBookByIdDesc();
        return $this->render('student/index.html.twig',
            [
                'students' => $students
            ]);
  }

  #[IsGranted('ROLE_USER')]
  #[Route('/list', name: 'app_student_list')]
  public function studentList () {
    $books = $this->getDoctrine()->getRepository(Book::class)->findAll();
    $session = new Session();
    $session->set('search', false);
    return $this->render('student/list.html.twig',
        [
            'students' => $students
        ]);
  }

    #[Route('/new', name: 'app_student_new', methods: ['GET', 'POST'])]
    public function new(Request $request, StudentRepository $studentRepository): Response
    {
        $student = new Student();
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $studentRepository->add($student);
            return $this->redirectToRoute('app_student_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('student/new.html.twig', [
            'student' => $student,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_student_show', methods: ['GET'])]
    public function show(Student $student): Response
    {
        return $this->render('student/show.html.twig', [
            'student' => $student,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_student_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Student $student, StudentRepository $studentRepository): Response
    {
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $studentRepository->add($student);
            return $this->redirectToRoute('app_student_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('student/edit.html.twig', [
            'student' => $student,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_student_delete', methods: ['POST'])]
    public function delete(Request $request, Student $student, StudentRepository $studentRepository)
    {
        if ($this->isCsrfTokenValid('delete'.$student->getId(), $request->request->get('_token'))) {
            $studentRepository->remove($student);
        }

        return $this->redirectToRoute('app_student_index', [], Response::HTTP_SEE_OTHER);
    }
    #[IsGranted('ROLE_USER')]
    #[Route('/search', name: 'app_search_book')]
    public function searchStudent(StudentRepository $studentRepository, Request $request) {
        $students = $studentRepository->searchStudent($request->get('keyword'));
        if ($books == null) {
          $this->addFlash("Warning", "No student found !");
        }
        $session = $request->getSession();
        $session->set('search', true);
        return $this->render('student/list.html.twig', 
        [
            'students' => $students,
        ]);
    }
}
