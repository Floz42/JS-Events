<?php

namespace App\Repository;

use App\Entity\OptionDelivery;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method OptionDelivery|null find($id, $lockMode = null, $lockVersion = null)
 * @method OptionDelivery|null findOneBy(array $criteria, array $orderBy = null)
 * @method OptionDelivery[]    findAll()
 * @method OptionDelivery[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OptionDeliveryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OptionDelivery::class);
    }

    // /**
    //  * @return OptionDelivery[] Returns an array of OptionDelivery objects
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
    public function findOneBySomeField($value): ?OptionDelivery
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
