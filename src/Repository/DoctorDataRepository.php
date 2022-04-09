<?php

namespace App\Repository;

use App\Entity\DoctorData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DoctorData|null find($id, $lockMode = null, $lockVersion = null)
 * @method DoctorData|null findOneBy(array $criteria, array $orderBy = null)
 * @method DoctorData[]    findAll()
 * @method DoctorData[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DoctorDataRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DoctorData::class);
    }

    // /**
    //  * @return DoctorData[] Returns an array of DoctorData objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DoctorData
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
