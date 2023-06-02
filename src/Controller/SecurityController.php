<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\RegistrationType;
use App\Form\UserPasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

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


    /**
         * This function allow us to modify the user password
         *
         * @param Utilisateur $utilisateur
         * @param Request $request
         * @param UserPasswordHasherInterface $hasher
         * @param EntityManagerInterface $manager
         * @return Response
         */
        #[Security("is_granted('ROLE_USER') and user === utilisateur || is_granted('ROLE_ADMIN')")]
        #[Route('/utilisateur/edition-mot-de-passe/{id}', 'user.edit.password', methods:['GET', 'POST'])]
        public function editPassword(
            Utilisateur $utilisateur,
            Request $request,
            UserPasswordHasherInterface $hasher,
            EntityManagerInterface $manager
        ) : Response
            {
                if(!$this->getUser()) {
                    return $this->redirectToRoute('security.login');
                }

                if($this->getUser() !== $utilisateur && !$this->isGranted('ROLE_ADMIN')){
                    return $this->redirectToRoute('app_home');
                }

                $form = $this->createForm(UserPasswordType::class);

                $form->handleRequest($request);
                if ($form->isSubmitted() && $form->isValid()) {
                    if ($hasher->isPasswordValid($utilisateur, $form->getData()['plainPassword'])) {
                        $utilisateur->setPassword($hasher->hashPassword(
                            $utilisateur,
                            $form->getData()['newPassword']
                        ));

                        $this->addFlash(
                            'Succes',
                            'Le mot de passe a été modifié avec succes.'
                        );

                        $manager->persist($utilisateur);
                        $manager->flush();

                        return $this->redirectToRoute('utilisateur.edit', ['id' => $utilisateur->getId()]);
                    }else{
                        $this->addFlash(
                            'warning',
                            'Le mot de passe renseigné est incorrect.'
                        );
                    }
                }

                return $this->render('pages/security/edit_password.html.twig', [
                    'form' => $form->createView()
                ]);
            }

}
