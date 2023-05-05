<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Plat;
use Faker\Generator;
use App\Entity\Detail;
use App\Entity\Commande;
use App\Entity\Categorie;
use App\Entity\Utilisateur;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }


    public function load(ObjectManager $manager): void
    {

        for($i = 1; $i<=50; $i++){

            $categorie = new Categorie();
            $commande = new Commande();
            $detail = new Detail();
            $plat =new Plat();
            $utilisateur = new Utilisateur();



            $categorie->setCatLibelle($this->faker->word())
                      ->setCatImage($this->faker->word() . '.jpg')
                      ->setCatActive($this->faker->randomDigitNotNull());



            $commande->setComTotal($this->faker->randomFloat(2, 10, 500))
                     ->setComDatecommande($this->faker->dateTime())
                     ->setComEtat($this->faker->numberBetween(0, 4));



            $detail->setDetQuantite($this->faker->randomNumber(2, false));  
            
            

            $plat->setPlatLibelle($this->faker->word())
                 ->setPlatDescription($this->faker->paragraph())
                 ->setPlatPrix($this->faker->randomFloat(2, 10, 500))
                 ->setPlatImage($this->faker->word() . '.jpg')
                 ->setPlatActive($this->faker->randomDigitNotNull());


            
            $utilisateur->setUtilEmail($this->faker->email())
                        ->setUtilPassword($this->faker->password())
                        ->setUtilNom($this->faker->word())
                        ->setUtilPrenom($this->faker->word())
                        ->setUtilTelephone($this->faker->mobileNumber());



            $manager->persist($categorie);
            $manager->persist($commande);
            $manager->persist($detail);
            $manager->persist($plat);
            $manager->persist($utilisateur);

        }


        $manager->flush();

    }
}