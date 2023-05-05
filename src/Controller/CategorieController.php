<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class CategorieController extends AbstractController
{   
    /**
     * This function display all (categories)
     *
     * @param CategorieRepository $repository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    #[Route('/categorie', name: 'categorie')]
    public function index(CategorieRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {
        $categories = $paginator->paginate(
            $repository->findAll(), 
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('pages/categorie/index.html.twig', [
            'categories' => $categories
        ]);

    }
}
