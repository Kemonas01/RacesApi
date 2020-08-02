<?php

namespace App\Repository;

use App\Entity\OrientationRace;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method OrientationRace|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrientationRace|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrientationRace[]    findAll()
 * @method OrientationRace[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrientationRaceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrientationRace::class);
    }

    // /**
    //  * @return OrientationRace[] Returns an array of OrientationRace objects
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
    public function findOneBySomeField($value): ?OrientationRace
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
