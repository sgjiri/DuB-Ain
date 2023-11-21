<?php

namespace App\Repository;

use App\Entity\SiteImage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SiteImage>
 *
 * @method SiteImage|null find($id, $lockMode = null, $lockVersion = null)
 * @method SiteImage|null findOneBy(array $criteria, array $orderBy = null)
 * @method SiteImage[]    findAll()
 * @method SiteImage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SiteImageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SiteImage::class);
    }

//    /**
//     * @return SiteImage[] Returns an array of SiteImage objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?SiteImage
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
