<?php

namespace App\Repository;

use App\Entity\Flights;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Flights|null find($id, $lockMode = null, $lockVersion = null)
 * @method Flights|null findOneBy(array $criteria, array $orderBy = null)
 * @method Flights[]    findAll()
 * @method Flights[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FlightsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Flights::class);
    }
}
