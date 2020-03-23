<?php

namespace App\Repository;

use App\Entity\ImageSlider;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ImageSlider|null find($id, $lockMode = null, $lockVersion = null)
 * @method ImageSlider|null findOneBy(array $criteria, array $orderBy = null)
 * @method ImageSlider[]    findAll()
 * @method ImageSlider[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImageSliderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ImageSlider::class);
    }

    // /**
    //  * @return ImageSlider[] Returns an array of ImageSlider objects
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
    public function findOneBySomeField($value): ?ImageSlider
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
