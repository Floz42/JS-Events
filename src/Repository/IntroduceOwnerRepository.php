<?php

namespace App\Repository;

use App\Entity\IntroduceOwner;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method IntroduceOwner|null find($id, $lockMode = null, $lockVersion = null)
 * @method IntroduceOwner|null findOneBy(array $criteria, array $orderBy = null)
 * @method IntroduceOwner[]    findAll()
 * @method IntroduceOwner[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IntroduceOwnerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IntroduceOwner::class);
    }

    // /**
    //  * @return IntroduceOwner[] Returns an array of IntroduceOwner objects
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
    public function findOneBySomeField($value): ?IntroduceOwner
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
