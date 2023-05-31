<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use App\Repository\PlatRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * page d'accueil
 */
class HomeController extends AbstractController
{
    /**
     * This function display the 3 best-selling 'plats' and the 6 most-popular categories
     *
     * @param CategorieRepository $catRepository
     * @param PlatRepository $platRepository
     * @return Response
     */
    #[Route('/', name: 'app_home')]
    public function index(CategorieRepository $catRepository, PlatRepository $platRepository): Response
    {

        $categories = $catRepository->FindCategoriesPopulaires();

        $plats = $platRepository->FindPlatsLesPlusVendus();

        return $this->render('pages/home.html.twig', ['categories' => $categories, 'plats' => $plats]);
    }

    

    /**
     * This function display the page 'Politique de confidentialité'
     *
     * @return Response
     */
    #[Route('/politiquedeconfidentialite', name: 'politiquedeconfidentialite')]
    public function politiquedeconfidentialite(): Response
    {
        return $this->render('pages/politique-mentions/poldeconfident.html.twig');
    }


    /**
     * This function display the page 'Mentions légales'
     *
     * @return Response
     */
    #[Route('/mentionslegales', name: 'mentionslegales')]
    public function mentionslegales(): Response
    {
        return $this->render('pages/politique-mentions/mentionslegales.html.twig');
    }
}
