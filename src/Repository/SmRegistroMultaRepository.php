<?php

namespace App\Repository;

use App\Entity\SmRegistroMulta;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SmRegistroMulta|null find($id, $lockMode = null, $lockVersion = null)
 * @method SmRegistroMulta|null findOneBy(array $criteria, array $orderBy = null)
 * @method SmRegistroMulta[]    findAll()
 * @method SmRegistroMulta[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SmRegistroMultaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SmRegistroMulta::class);
    }

    // /**
    //  * @return SmRegistroMulta[] Returns an array of SmRegistroMulta objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SmRegistroMulta
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
