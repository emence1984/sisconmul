<?php

namespace App\Repository;

use App\Entity\SmUsuario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;

/**
 * @method SmUsuario|null find($id, $lockMode = null, $lockVersion = null)
 * @method SmUsuario|null findOneBy(array $criteria, array $orderBy = null)
 * @method SmUsuario[]    findAll()
 * @method SmUsuario[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method SmUsuario[]    loadUserByUsername(string $usernameOrEmail))
 */
class SmUsuarioRepository extends ServiceEntityRepository implements UserLoaderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SmUsuario::class);
    }



    public function loadUserByUsername(string $usernameOrEmail): ?SmUsuario
    {
        $entityManager = $this->getEntityManager();

        return $entityManager->createQuery(
                'SELECT u
                FROM App\Entity\SmUsuario u
                WHERE u.usuario = :usuario'
            )
            ->setParameter('usuario', $usernameOrEmail)
            ->getOneOrNullResult();
    }

    // /**
    //  * @return SmUsuario[] Returns an array of SmUsuario objects
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
    public function findOneBySomeField($value): ?SmUsuario
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
