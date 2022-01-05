<?php

namespace App\Repository;

use App\Entity\Hackcompte;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Hackcompte|null find($id, $lockMode = null, $lockVersion = null)
 * @method Hackcompte|null findOneBy(array $criteria, array $orderBy = null)
 * @method Hackcompte[]    findAll()
 * @method Hackcompte[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HackcompteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Hackcompte::class);
    }

    // /**
    //  * @return Hackcompte[] Returns an array of Hackcompte objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Hackcompte
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
