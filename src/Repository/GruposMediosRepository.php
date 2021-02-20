<?php

namespace App\Repository;

use App\Entity\GruposMedios;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GruposMedios|null find($id, $lockMode = null, $lockVersion = null)
 * @method GruposMedios|null findOneBy(array $criteria, array $orderBy = null)
 * @method GruposMedios[]    findAll()
 * @method GruposMedios[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GruposMediosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GruposMedios::class);
    }

    // /**
    //  * @return GruposMedios[] Returns an array of GruposMedios objects
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
    public function findOneBySomeField($value): ?GruposMedios
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
