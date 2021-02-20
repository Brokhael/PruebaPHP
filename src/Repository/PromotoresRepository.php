<?php

namespace App\Repository;

use App\Entity\Promotores;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Promotores|null find($id, $lockMode = null, $lockVersion = null)
 * @method Promotores|null findOneBy(array $criteria, array $orderBy = null)
 * @method Promotores[]    findAll()
 * @method Promotores[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PromotoresRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Promotores::class);
    }

    // /**
    //  * @return Promotores[] Returns an array of Promotores objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Promotores
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
