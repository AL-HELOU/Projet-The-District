<?php

namespace App\Form;

use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;


class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('util_email', EmailType::class,[
                'attr' => [
                    'class' => 'form-control',
                    'minlength' => '2',
                    'maxlength' => '50'
                ],
                'label' => 'E-mail :',
                'label_attr' => [
                    'class' => 'form-label mt-4 d-flex justify-content-center'
                ],
                'constraints' => [
                    new Assert\Length(['min' => 2, 'max' => 50]),
                    new Assert\NotBlank(),
                    new Assert\Email()
                ]
            ])


            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'attr' => [
                        'class' => 'form-control'
                    ],
                    'label' => 'Mot de passe :',
                    'label_attr' => [
                        'class' => 'form-label mt-4 d-flex justify-content-center'
                    ]
                ],

                'second_options' => [
                    'attr' => [
                        'class' => 'form-control'
                    ],
                    'label' => 'Confirmation du mot de passe :',
                    'label_attr' => [
                        'class' => 'form-label mt-4 d-flex justify-content-center'
                    ]
                ],
                'invalid_message' => 'Les mots de passe ne correspondent pas'
            ])


            ->add('util_nom', TextType::class,[
                'attr' => [
                    'class' => 'form-control',
                    'minlength' => '2',
                    'maxlength' => '50'
                ],
                'label' => 'Nom :',
                'label_attr' => [
                    'class' => 'form-label mt-4 d-flex justify-content-center'
                ],
                'constraints' => [
                    new Assert\Length(['min' => 2, 'max' => 50]),
                    new Assert\NotBlank()
                ]
            ])


            ->add('util_prenom', TextType::class,[
                'attr' => [
                    'class' => 'form-control',
                    'minlength' => '2',
                    'maxlength' => '50'
                ],
                'label' => 'Prenom :',
                'label_attr' => [
                    'class' => 'form-label mt-4 d-flex justify-content-center'
                ],
                'constraints' => [
                    new Assert\Length(['min' => 2, 'max' => 50]),
                    new Assert\NotBlank()
                ]
            ])


            ->add('util_telephone', TextType::class,[
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Téléphone :',
                'label_attr' => [
                    'class' => 'form-label mt-4 d-flex justify-content-center'
                ],
                'constraints' => [
                    new Assert\Length(['min' => 2, 'max' => 20]),
                    new Assert\NotBlank()
                ]
            ])


            ->add('util_adresse', TextType::class,[
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Adresse :',
                'label_attr' => [
                    'class' => 'form-label mt-4 d-flex justify-content-center'
                ],
                'constraints' => [
                    new Assert\Length(['min' => 2, 'max' => 50]),
                    new Assert\NotBlank()
                ]
            ])


            ->add('util_cp', TextType::class,[
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Code postal :',
                'label_attr' => [
                    'class' => 'form-label mt-4 d-flex justify-content-center'
                ],
                'constraints' => [
                    new Assert\Length(['min' => 2, 'max' => 20]),
                    new Assert\NotBlank()
                ]
            ])



            ->add('util_ville', TextType::class,[
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'La ville :',
                'label_attr' => [
                    'class' => 'form-label mt-4 d-flex justify-content-center'
                ],
                'constraints' => [
                    new Assert\Length(['min' => 2, 'max' => 50]),
                    new Assert\NotBlank()
                ]
            ])


            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary mt-3'
                ],
                'label' => 'Créer mon compte',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
