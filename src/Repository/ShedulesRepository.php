<?php

namespace App\Repository;

use App\Entity\Shedules;
use App\Exceptions\NotFoundException;
use App\Exceptions\WrongAirportNameExcpertion;
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
    public function __construct(RegistryInterface $registry, AirportsRepository $airportsRepository, FlightsRepository $flightsRepository)
    {
        parent::__construct($registry, Shedules::class);
        $this->airportsRepositiry = $airportsRepository;
        $this->flightsRepository = $flightsRepository;

    }

    public function findRoute($from, $to, $date)
    {
        $departureAirport = $this->airportsRepositiry->findOneByCode($from);
        $arrivalAirport = $this->airportsRepositiry->findOneByCode($to);
        if (is_null($departureAirport) || is_null($arrivalAirport)) {
            throw new WrongAirportNameExcpertion('Неверное указано имя аэропорта', '400');
        }

        $result = $this->findByFields($departureAirport, $arrivalAirport, $date);
        if(\count($result) > 0){
            return $result;
        }

        throw new NotFoundException('Маршрут не найден', 404);

    }

    public function findByFields($from, $to, $date)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.departure_airport_id = :from')
            ->setParameter('from', $from->getId())
            ->andWhere('s.arrival_airport_id = :to')
            ->setParameter('to', $to->getId())
            ->andWhere('s.departure_datetime >= :fromDate')
            ->setParameter('fromDate', $this->addFromTime($date))
            ->andWhere('s.departure_datetime <= :toDate')
            ->setParameter('toDate', $this->addToTime($date))
            ->orderBy('s.departure_datetime')
            ->getQuery()
            ->getResult()
            ;
    }

    private function addFromTime($date)
    {
        return $date . ' 00:00:00';
    }

    private function addToTime($date)
    {
        return $date . ' 23:59:59';
    }
}
