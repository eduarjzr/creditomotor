<?php

namespace App\Repository;

use App\Entity\ModelYear;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ModelYear|null find($id, $lockMode = null, $lockVersion = null)
 * @method ModelYear|null findOneBy(array $criteria, array $orderBy = null)
 * @method ModelYear[]    findAll()
 * @method ModelYear[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ModelYearRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ModelYear::class);
    }

    // /**
    //  * @return ModelYear[] Returns an array of ModelYear objects
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
    public function findOneBySomeField($value): ?ModelYear
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
