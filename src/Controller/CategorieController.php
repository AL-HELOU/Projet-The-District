<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Form\CategorieType;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
    #[Route('/categorie', name: 'categorie', methods: ['GET'])]
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



    /**
     * this function show a form to create a category
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Route('/categorie/nouveau', 'categorie.new', methods:['GET', 'POST'])]
    public function new(
        Request $request,
        EntityManagerInterface $manager
    ) : Response
        {
            $categorie = new Categorie();
            $form = $this->createForm(CategorieType::class, $categorie);

            $form->handleRequest($request);
            
            if ($form->isSubmitted() && $form->isValid()) {

                $categorie = $form->getData();

                $manager->persist($categorie);
                $manager->flush();

                $this->addFlash(
                    'Succes',
                    'La categorie a été créé avec succes'
                );

                return $this->redirectToRoute('categorie');
            }

            return $this->render('pages/categorie/new.html.twig', [
                'form' => $form->createView()
            ]);
        }


    /**
     * this function show a form to modify a category
     *
     * @param Categorie $categorie
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */ 
    #[Route('/categorie/edition/{id}', 'categorie.edit', methods: ['GET', 'POST'])]
    public function edit(
        Categorie $categorie,
        Request $request,
        EntityManagerInterface $manager
    ) : Response
        {
            $form = $this->createForm(CategorieType::class, $categorie);

            $form->handleRequest($request);
            
            if ($form->isSubmitted() && $form->isValid()) {

                $categorie = $form->getData();

                $manager->persist($categorie);
                $manager->flush();

                $this->addFlash(
                    'Succes',
                    'La categorie a été modifié avec succes'
                );

                return $this->redirectToRoute('categorie');
            }

            return $this->render('pages/categorie/edit.html.twig', [
                'form' => $form->createView()
            ]);
        }


    
   /**
    * this function delete a category
    *
    * @param EntityManagerInterface $manager
    * @param Categorie $categorie
    * @return Response
    */ 
    #[Route('/categorie/suppression/{id}', 'categorie.delete', methods: ['GET'])]
    public function delete(
        EntityManagerInterface $manager,
        Categorie $categorie
    ) : Response 
        {
            $manager->remove($categorie);
            $manager->flush();

            $this->addFlash(
                'Succes',
                'La categorie a été supprimé avec succes'
            );

            return $this->redirectToRoute('categorie');
        }


}