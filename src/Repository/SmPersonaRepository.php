<?php

namespace App\Repository;

use App\Entity\SmPersona;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SmPersona|null find($id, $lockMode = null, $lockVersion = null)
 * @method SmPersona|null findOneBy(array $criteria, array $orderBy = null)
 * @method SmPersona[]    findAll()
 * @method SmPersona[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SmPersonaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SmPersona::class);
    }


    /**
     * @return SmPersona[]
     */
    public function findAll(): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT p
            FROM App\Entity\SmPersona p
            WHERE p.estado IS NULL
            ORDER BY p.apellido  ASC'
        );

        // returns an array of Product objects
        return $query->getResult();
    }


    // /**
    //  * @return SmPersona[] Returns an array of SmPersona objects
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
    public function findOneBySomeField($value): ?SmPersona
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
