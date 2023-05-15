<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\UtilisateurType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UtilisateurRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UtilisateurController extends AbstractController
{
    /**
    * This function display all (users)
    *
    * @param UtilisateurRepository $repository
    * @param PaginatorInterface $paginator
    * @param Request $request
    * @return Response
    */
   #[Route('/utilisateur', name: 'utilisateur', methods: ['GET'])]
   public function index(UtilisateurRepository $repository, PaginatorInterface $paginator, Request $request): Response
   {
       $utilisateurs = $paginator->paginate(
           $repository->findAll(), 
           $request->query->getInt('page', 1),
           10
       );

       return $this->render('pages/utilisateur/index.html.twig', [
           'utilisateurs' => $utilisateurs
       ]);
   }


   /**
    * Undocumented function
    *
    * @param Request $request
    * @param EntityManagerInterface $manager
    * @return Response
    */
   #[Route('/utilisateur/nouveau', 'utilisateur.new', methods:['GET', 'POST'])]
   public function new(
       Request $request,
       EntityManagerInterface $manager
   ) : Response
   {
       $utilisateur = new Utilisateur();
       $form = $this->createForm(UtilisateurType::class, $utilisateur);

       $form->handleRequest($request);
       
       if ($form->isSubmitted() && $form->isValid()) {

           $utilisateur = $form->getData();

           $manager->persist($utilisateur);
           $manager->flush();

           $this->addFlash(
               'Succes',
               "L'utilisateur' a été ajouté avec succes"
           );

           return $this->redirectToRoute('utilisateur');
       }

       return $this->render('pages/utilisateur/new.html.twig', [
           'form' => $form->createView()
       ]);
   }



   /**
     * this function show a form to modify a plat
     *
     * @param Utilisateur $utilisateur
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */ 
    #[Route('/utilisateur/edition/{id}', 'utilisateur.edit', methods: ['GET', 'POST'])]
    public function edit(
        Utilisateur $utilisateur,
        Request $request,
        EntityManagerInterface $manager
    ) : Response
        {
            $form = $this->createForm(UtilisateurType::class, $utilisateur);

            $form->handleRequest($request);
            
            if ($form->isSubmitted() && $form->isValid()) {

                $utilisateur = $form->getData();

                $manager->persist($utilisateur);
                $manager->flush();

                $this->addFlash(
                    'Succes',
                    'L\'utilisateur a été modifié avec succes'
                );

                return $this->redirectToRoute('utilisateur');
            }

            return $this->render('pages/utilisateur/edit.html.twig', [
                'form' => $form->createView()
            ]);
        }


        /**
    * this function delete a user
    *
    * @param EntityManagerInterface $manager
    * @param Utilisateur $utilisateur
    * @return Response
    */ 
    #[Route('/utilisateur/suppression/{id}', 'utilisateur.delete', methods: ['GET'])]
    public function delete(
        EntityManagerInterface $manager,
        Utilisateur $utilisateur
    ) : Response 
        {

            $manager->remove($utilisateur);
            $manager->flush();

            $this->addFlash(
                'Succes',
                'L\'utilisateur a été supprimé avec succes'
            );

            return $this->redirectToRoute('utilisateur');
        }

}