<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class UserPasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

        ->add('plainPassword', PasswordType::class, [
            'attr' => ['class' => 'form-control'],
            'label' => 'Votre mot de passe',
            'label_attr' => ['class' => 'form-label mt-4 d-flex justify-content-center'],
            'constraints' => [new Assert\NotBlank()]
        ])



        ->add('newPassword', RepeatedType::class, [
            'type' => PasswordType::class,
            'first_options' => [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Nouveau mot de passe :',
                'label_attr' => [
                    'class' => 'form-label mt-4 d-flex justify-content-center'
                ]
            ],

            'second_options' => [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Confirmation du nouveau mot de passe :',
                'label_attr' => [
                    'class' => 'form-label mt-4 d-flex justify-content-center'
                ]
            ],
            'invalid_message' => 'Les mots de passe ne correspondent pas'
        ])

        ->add('Submit', SubmitType::class, [
            'attr' => [
                'class' => 'btn btn-success mt-3'
            ],
            'label' => 'Modifier',
        ]);
    }
}