<?php

namespace App\Repository;

use App\Entity\VwMultasRegistradas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method VwMultasRegistradas|null find($id, $lockMode = null, $lockVersion = null)
 * @method VwMultasRegistradas|null findOneBy(array $criteria, array $orderBy = null)
 * @method VwMultasRegistradas[]    findAll()
 * @method VwMultasRegistradas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VwMultasRegistradasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VwMultasRegistradas::class);
    }

    // /**
    //  * @return VwMultasRegistradas[] Returns an array of VwMultasRegistradas objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?VwMultasRegistradas
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */


    


}
