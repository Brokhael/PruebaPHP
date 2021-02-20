<?php

namespace App\Repository;

use App\Entity\Medios;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Medios|null find($id, $lockMode = null, $lockVersion = null)
 * @method Medios|null findOneBy(array $criteria, array $orderBy = null)
 * @method Medios[]    findAll()
 * @method Medios[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MediosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Medios::class);
    }

    // /**
    //  * @return Medios[] Returns an array of Medios objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Medios
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
