<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * this controller allow us to login
     *
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    #[Route('/connexion', name: 'security.login', methods: ['GET', 'POST'])]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $lastUsername = $authenticationUtils->getLastUsername();
        $error = $authenticationUtils->getLastAuthenticationError();


        return $this->render('pages/security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }


    /**
     * this controller allow us to logout
     *
     * @return void
     */
    #[Route('/deconnexion', 'security.logout')]
    public function logout()
    {
        // Nothing to do here
    }



    /**
     * this controller allow us to register
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Route('/inscription', 'security.registration', methods:['GET', 'POST'])]
    public function registration(Request $request, EntityManagerInterface $manager) : Response
    {
        $utilisateur = new Utilisateur();
        $utilisateur->setRoles(['ROLE_USER']);
        $form = $this->createForm(RegistrationType::class , $utilisateur);

        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid())
        {
            $utilisateur = $form->getData();

            $this->addFlash(
                'Succes',
                'Votre compte a bien été créé'
            );

            $manager->persist($utilisateur);
            $manager->flush();

            return $this->redirectToRoute('security.login');
        }

        return $this->render('pages/security/registration.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
