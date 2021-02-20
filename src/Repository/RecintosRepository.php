<?php

namespace App\Repository;

use App\Entity\Recintos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Recintos|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recintos|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recintos[]    findAll()
 * @method Recintos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecintosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recintos::class);
    }

    // /**
    //  * @return Recintos[] Returns an array of Recintos objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Recintos
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
