<?php

namespace App\Repository;

use App\Entity\GruposConciertos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GruposConciertos|null find($id, $lockMode = null, $lockVersion = null)
 * @method GruposConciertos|null findOneBy(array $criteria, array $orderBy = null)
 * @method GruposConciertos[]    findAll()
 * @method GruposConciertos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GruposConciertosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GruposConciertos::class);
    }

    // /**
    //  * @return GruposConciertos[] Returns an array of GruposConciertos objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GruposConciertos
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
