<?php

namespace App\Repository;

use App\Entity\Transporters;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Transporters|null find($id, $lockMode = null, $lockVersion = null)
 * @method Transporters|null findOneBy(array $criteria, array $orderBy = null)
 * @method Transporters[]    findAll()
 * @method Transporters[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TransportersRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Transporters::class);
    }

    // /**
    //  * @return Transporters[] Returns an array of Transporters objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Transporters
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
