<?php

namespace App\Repository;

use App\Entity\Shedules;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Shedules|null find($id, $lockMode = null, $lockVersion = null)
 * @method Shedules|null findOneBy(array $criteria, array $orderBy = null)
 * @method Shedules[]    findAll()
 * @method Shedules[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShedulesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Shedules::class);
    }

    // /**
    //  * @return Shedules[] Returns an array of Shedules objects
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
    public function findOneBySomeField($value): ?Shedules
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
