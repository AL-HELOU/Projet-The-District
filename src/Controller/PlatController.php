<?php

namespace App\Controller;

use App\Entity\Plat;
use App\Form\PlatType;
use App\Repository\PlatRepository;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class PlatController extends AbstractController
{
    /**
     * This function display all (plats) for the (Admin)
     *
     * @param PlatRepository $repository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    #[Route('/plat', name: 'plat', methods: ['GET'])]
    public function index(PlatRepository $repository, CategorieRepository $catrepository, PaginatorInterface $paginator, Request $request): Response
    {
        $plats = $paginator->paginate(
            $repository->findAll(), 
            $request->query->getInt('page', 1),
            10
        );

        $categories = $catrepository->findAll();

        return $this->render('pages/plat/index.html.twig', [
            'plats' => $plats,
            'categories' => $categories
        ]);
    }



    /**
     * This function display all (plats) for the (user)
     *
     * @param PlatRepository $repository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    #[Route('/plats', name: 'plats', methods: ['GET'])]
    public function home(PlatRepository $repository, CategorieRepository $catrepository, PaginatorInterface $paginator, Request $request): Response
    {
        $plats = $paginator->paginate(
            $repository->findAll(), 
            $request->query->getInt('page', 1),
            6
        );

        $categories = $catrepository->findAll();

        return $this->render('pages/plat/home.html.twig', [
            'plats' => $plats,
            'categories' => $categories
        ]);
    }


    /**
     * This function display the (plats) that are in the category
     *
     * @param PlatRepository $repository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    #[Route('/platscategorie', name: 'platscategorie', methods: ['GET'])]
    public function platscategorie(PlatRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {
        $plats = $paginator->paginate(
            $repository->findBy(['plat_categorie']), 
            $request->query->getInt('page', 1),
            6
        );

        return $this->render('pages/plat/platscategorie.html.twig', [
            'plats' => $plats,
        ]);
    }



    /**
     * This function show a form to add a plat
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Route('/plat/nouveau', 'plat.new', methods:['GET', 'POST'])]
    public function new(
        Request $request,
        EntityManagerInterface $manager
    ) : Response
    {
        $plat = new Plat();
        $form = $this->createForm(PlatType::class, $plat);

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {

            $plat = $form->getData();

            $manager->persist($plat);
            $manager->flush();

            $this->addFlash(
                'Succes',
                'Le plat a été créé avec succes'
            );

            return $this->redirectToRoute('plat');
        }

        return $this->render('pages/plat/new.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * This function show a form to modify a plat
     *
     * @param Plat $plat
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */ 
    #[Route('/plat/edition/{id}', 'plat.edit', methods: ['GET', 'POST'])]
    public function edit(
        Plat $plat,
        Request $request,
        EntityManagerInterface $manager
    ) : Response
        {
            $form = $this->createForm(PlatType::class, $plat);

            $form->handleRequest($request);
            
            if ($form->isSubmitted() && $form->isValid()) {

                $plat = $form->getData();

                $manager->persist($plat);
                $manager->flush();

                $this->addFlash(
                    'Succes',
                    'Le plat a été modifié avec succes'
                );

                return $this->redirectToRoute('plat');
            }

            return $this->render('pages/plat/edit.html.twig', [
                'form' => $form->createView()
            ]);
        }


    /**
    * this function delete a plat
    *
    * @param EntityManagerInterface $manager
    * @param Plat $plat
    * @return Response
    */ 
    #[Route('/plat/suppression/{id}', 'plat.delete', methods: ['GET'])]
    public function delete(
        EntityManagerInterface $manager,
        Plat $plat
    ) : Response 
        {
            $manager->remove($plat);
            $manager->flush();

            $this->addFlash(
                'Succes',
                'Le plat a été supprimé avec succes'
            );

            return $this->redirectToRoute('plat');
        }


}
