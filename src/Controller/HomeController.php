<?php

namespace App\Controller;

use App\Repository\StudentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(StudentRepository $studentRepository)
    {
//        $students = $studentRepository->findByAge(11);
//        $students = $studentRepository->findBy(['age'=>11]);
//        $students = $studentRepository->findBy(['age'=>11, 'firstname'=>'Harry']);
//        $students = $studentRepository->findBy([], ['lastname'=>'ASC'], 3, 1);
//        $students = $studentRepository->findAgeGreaterThan(12);
//        $students = $studentRepository->findLikeFirstname('H');
//        $students = $studentRepository->findLikeFullname('y');
        $students = $studentRepository->findInSchool('Serp');

        return $this->render('home/index.html.twig', [
            'students' => $students,
        ]);
    }
}
