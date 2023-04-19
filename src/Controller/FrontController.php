<?php

namespace App\Controller;

use App\Repository\BookRepository;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{
    #[Route('/', name: 'app_front')]
    public function index(BookRepository $bookRepository): Response
    {

        $books = $bookRepository->findAll();

        return $this->render('front/index.html.twig', [
            'books' => $books,
        ]);
    }

    public function navCategories(CategorieRepository $categorieRepository)
    {
        $categories = $categorieRepository->findAll();

        return $this->render('front/navCategorie.html.twig', [
            'categories' => $categories,
        ]);
    }
}
