<?php

namespace App\Repository;

use App\Entity\Introduce;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Introduce|null find($id, $lockMode = null, $lockVersion = null)
 * @method Introduce|null findOneBy(array $criteria, array $orderBy = null)
 * @method Introduce[]    findAll()
 * @method Introduce[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IntroduceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Introduce::class);
    }

    // /**
    //  * @return Introduce[] Returns an array of Introduce objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Introduce
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
