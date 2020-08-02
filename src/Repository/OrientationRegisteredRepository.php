<?php

namespace App\Repository;

use App\Entity\OrientationRegistered;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method OrientationRegistered|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrientationRegistered|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrientationRegistered[]    findAll()
 * @method OrientationRegistered[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrientationRegisteredRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrientationRegistered::class);
    }

    // /**
    //  * @return OrientationRegistered[] Returns an array of OrientationRegistered objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OrientationRegistered
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
