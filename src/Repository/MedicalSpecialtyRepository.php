<?php

namespace App\Repository;

use App\Entity\MedicalSpecialty;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MedicalSpecialty|null find($id, $lockMode = null, $lockVersion = null)
 * @method MedicalSpecialty|null findOneBy(array $criteria, array $orderBy = null)
 * @method MedicalSpecialty[]    findAll()
 * @method MedicalSpecialty[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MedicalSpecialtyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MedicalSpecialty::class);
    }

    // /**
    //  * @return MedicalSpecialty[] Returns an array of MedicalSpecialty objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MedicalSpecialty
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
