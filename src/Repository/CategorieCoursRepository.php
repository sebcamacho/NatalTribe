<?php

namespace App\Repository;

use App\Entity\CategorieCours;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CategorieCours|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategorieCours|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategorieCours[]    findAll()
 * @method CategorieCours[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorieCoursRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategorieCours::class);
    }

    // /**
    //  * @return CategorieCours[] Returns an array of CategorieCours objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CategorieCours
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
