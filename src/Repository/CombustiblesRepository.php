<?php

namespace App\Repository;

use App\Entity\Combustibles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Combustibles|null find($id, $lockMode = null, $lockVersion = null)
 * @method Combustibles|null findOneBy(array $criteria, array $orderBy = null)
 * @method Combustibles[]    findAll()
 * @method Combustibles[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CombustiblesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Combustibles::class);
    }

    // /**
    //  * @return Combustibles[] Returns an array of Combustibles objects
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
    public function findOneBySomeField($value): ?Combustibles
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
