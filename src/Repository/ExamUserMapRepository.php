<?php

namespace App\Repository;

use App\Entity\ExamUserMap;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ExamUserMap>
 *
 * @method ExamUserMap|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExamUserMap|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExamUserMap[]    findAll()
 * @method ExamUserMap[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExamUserMapRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExamUserMap::class);
    }

    //    /**
    //     * @return ExamUserMap[] Returns an array of ExamUserMap objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('e.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?ExamUserMap
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
