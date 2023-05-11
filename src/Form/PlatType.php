<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Plat;
use App\Repository\CategorieRepository;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class PlatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('plat_libelle', TextType::class,[
                'attr' => [
                    'class' => 'form-control',
                    'minlength' => '2',
                    'maxlength' => '50'
                ],
                'label' => 'Plat Libelle :',
                'label_attr' => [
                    'class' => 'form-label mt-4 d-flex justify-content-center'
                ],
                'constraints' => [
                    new Assert\Length(['min' => 2, 'max' => 50]),
                    new Assert\NotBlank()
                ]
            ])


            ->add('plat_description', TextareaType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Plat description :',
                'label_attr' => [
                    'class' => 'form-label mt-4 d-flex justify-content-center'
                ]
            ])


            ->add('plat_prix', MoneyType::class, [
                'currency' => false,
                'attr' => [
                    'class' => 'form-control mb-4',
                ],
                'label' => 'Prix € :',
                'label_attr' => [
                    'class' => 'form-label mt-4 d-flex justify-content-center'
                ],
                'constraints' => [
                    new Assert\Positive(),
                ]
                ])

            
            ->add('plat_image', TextType::class,[
                'attr' => [
                    'class' => 'form-control mb-4',
                    'minlength' => '2',
                    'maxlength' => '50'
                ],
                'label' => 'Plat Image :',
                'label_attr' => [
                    'class' => 'form-label mt-4 d-flex justify-content-center'
                ],
                'constraints' => [
                    new Assert\Length(['min' => 2, 'max' => 50]),
                    new Assert\NotBlank()
                ]
                ])


            ->add('plat_active',CheckboxType::class, [
                'attr' => [
                    'class' => 'form-check-input ms-4',
                    'id' => 'flexCheckDefault'
                ],
                'label'    => 'Active ?',
                'required' => false,
                'label_attr' => [
                    'class' => 'form-check-label',
                    'for' => 'flexCheckDefault'
                ]
            ])

            ->add('plat_categorie', EntityType::class, [
                'attr' => ['class' => 'form-select form-select-lg mb-4'],
                'class' => Categorie::class,
                'query_builder' => function (CategorieRepository $r){
                    return $r->createQueryBuilder('i')
                             ->orderBy('i.cat_libelle', 'ASC');
                    },
                'label' => 'Choisissez la categorie :',
                'label_attr' => [
                    'class' => 'form-label mt-4 d-flex justify-content-center'
                ],
            
                'choice_label' => 'cat_libelle',
            ])    

            
            ->add('save', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary mt-4'
                ],
                'label' => 'Créer le plat',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Plat::class,
        ]);
    }
}
