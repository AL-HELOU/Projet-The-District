<?php

namespace App\Repository;

use App\Entity\Categorie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Categorie>
 *
 * @method Categorie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Categorie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Categorie[]    findAll()
 * @method Categorie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Categorie::class);
    }

    public function save(Categorie $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Categorie $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /*
    /**
    * @return Categorie[] Returns an array of Categorie objects
    */
   /*public function FindCategoriesPopulaires(): array
   {
       $dql = ' SELECT categorie.cat_image, categorie.cat_libelle, COUNT(details.det_plat) AS platsum FROM App\Entity\Categorie as categorie
                JOIN categorie.cat_plats plats
                JOIN plats.plat_details details
                GROUP BY details
                ORDER BY platsum DESC
                ';

                $query = $this->getEntityManager()->createQuery($dql); 

                return $query->getResult();
   }*/


    /**
    * @return Categorie[] Returns an array of Categorie objects - (the 6 most-popular categories)
    */
    public function FindCategoriesPopulaires(): array
    {
        $qb = $this->createQueryBuilder('categorie')
                        ->select('categorie.cat_image, categorie.cat_libelle, SUM(details.det_quantite) AS quasum')
                        ->join('categorie.cat_plats' , 'plats')
                        ->join('plats.plat_details', 'details')
                        ->groupBy('categorie.cat_image , categorie.cat_libelle')
                        ->orderBy('quasum', 'DESC')
                        ->setMaxResults(6)                        
                        ;

       $query = $qb->getQuery();

       return $query->getResult();
    }
}
