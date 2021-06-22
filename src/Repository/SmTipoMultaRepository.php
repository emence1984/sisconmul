<?php

namespace App\Repository;

use App\Entity\SmTipoMulta;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SmTipoMulta|null find($id, $lockMode = null, $lockVersion = null)
 * @method SmTipoMulta|null findOneBy(array $criteria, array $orderBy = null)
 * @method SmTipoMulta[]    listadoTipo()
 * @method SmTipoMulta[]    findAll()
 * @method SmTipoMulta[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SmTipoMultaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SmTipoMulta::class);
    }
    

     /**
     * @return SmTipoMulta[]
     */
    public function findAll(): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT p
            FROM App\Entity\SmTipoMulta p
            ORDER BY p.descripcion  ASC'
        );

        // returns an array of Product objects
        return $query->getResult();
    }


     /**
     * @return SmTipoMulta[]
     */
    public function listadoTipo(): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT p.descripcion, p.descripcion des2 
            FROM App\Entity\SmTipoMulta p
            ORDER BY p.descripcion  ASC'
        );

        // returns an array of Product objects
        return $query->getResult();
    }

    // /**
    //  * @return SmTipoMulta[] Returns an array of SmTipoMulta objects
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
    public function findOneBySomeField($value): ?SmTipoMulta
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
