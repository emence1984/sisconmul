<?php

namespace App\Repository;

use App\Entity\SmRegistroMultaDetalle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SmRegistroMultaDetalle|null find($id, $lockMode = null, $lockVersion = null)
 * @method SmRegistroMultaDetalle|null findOneBy(array $criteria, array $orderBy = null)
 * @method SmRegistroMultaDetalle[]    findAll()
 * @method SmRegistroMultaDetalle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SmRegistroMultaDetalleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SmRegistroMultaDetalle::class);
    }

    // /**
    //  * @return SmRegistroMultaDetalle[] Returns an array of SmRegistroMultaDetalle objects
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
    public function findOneBySomeField($value): ?SmRegistroMultaDetalle
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
