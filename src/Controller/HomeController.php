<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use App\Repository\PlatRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(CategorieRepository $catRepository, PlatRepository $platRepository): Response
    {

        $categories = $catRepository->FindCategoriesPopulaires();

        $plats = $platRepository->FindPlatsLesPlusVendus();

        return $this->render('pages/home.html.twig', ['categories' => $categories, 'plats' => $plats]);
    }

    

    #[Route('/politiquedeconfidentialite', name: 'politiquedeconfidentialite')]
    public function politiquedeconfidentialite(): Response
    {
        return $this->render('pages/politique-mentions/poldeconfident.html.twig');
    }


    #[Route('/mentionslegales', name: 'mentionslegales')]
    public function mentionslegales(): Response
    {
        return $this->render('pages/politique-mentions/mentionslegales.html.twig');
    }
}
