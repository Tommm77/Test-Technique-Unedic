<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Student;
use App\Form\StudentType;

class StudentController extends AbstractController
{
    /**
     * @Route("/student", name="app_student")
     */
    public function index(Request $request, EntityManagerInterface $entityManager): Response
{
    $student = new Student();

    $form = $this->createForm(StudentType::class, $student);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()){
        $entityManager->persist($student);
        $entityManager->flush();
    }

    return $this->render('student/index.html.twig', [
        'form' => $form->createView()
    ]);
}
}
