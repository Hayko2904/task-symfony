<?php

namespace App\Repository;

use App\Entity\Intervals;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Intervals>
 *
 * @method Intervals|null find($id, $lockMode = null, $lockVersion = null)
 * @method Intervals|null findOneBy(array $criteria, array $orderBy = null)
 * @method Intervals[]    findAll()
 * @method Intervals[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IntervalsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Intervals::class);
    }

    public function findRange($value, $length = 0): ?array
    {
        return $this->createQueryBuilder('i')
            ->select('i.id')
            ->where('i.min <= :val')
            ->andWhere('i.max >= :val')
            ->setParameter('val', $value . str_repeat('0', $length - strlen($value)))
            ->getQuery()
            ->getOneOrNullResult();
    }

//    /**
//     * @return Intervals[] Returns an array of Intervals objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Intervals
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
