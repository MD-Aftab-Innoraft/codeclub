<?php

namespace App\Repository;

use App\Entity\ExamRecords;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ExamRecords>
 *
 * @method ExamRecords|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExamRecords|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExamRecords[]    findAll()
 * @method ExamRecords[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExamRecordsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExamRecords::class);
    }

    //    /**
    //     * @return ExamRecords[] Returns an array of ExamRecords objects
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

    //    public function findOneBySomeField($value): ?ExamRecords
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
