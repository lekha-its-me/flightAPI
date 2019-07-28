<?php
/**
 * Created by PhpStorm.
 * User: lekha
 * Date: 28.07.2019
 * Time: 21:55
 */

namespace App\Mappers;

use App\Repository\AirportsRepository;
use App\Repository\FlightsRepository;
use App\Repository\TransportersRepository;

class ShedulesMapper
{
    public function __construct(AirportsRepository $airportsRepository, FlightsRepository $flightsRepository, TransportersRepository $transportersRepository)
    {
        $this->airportsRepository = $airportsRepository;
        $this->flightsRepository = $flightsRepository;
        $this->transportersRepository = $transportersRepository;
    }

    public function shedulesEntityToResponse($shedule)
    {
        $transporter = $this->transportersRepository->findOneBy(['id' => $shedule->getTransporterId()]);
        $flights = $this->flightsRepository->findOneBy(['id' => $shedule->getFlightId()]);
        $departureAirport = $this->airportsRepository->findOneBy(['id' => $shedule->getDepartureAirportId()]);
        $arrivalAirport = $this->airportsRepository->findOneBy(['id' => $shedule->getArrivalAirportId()]);

        return array(
            'transporter' => array(
                'code' => $transporter->getCode(),
                'name' => $transporter->getName()
            ),
            'flightNumber' => $flights->getNumber(),
            'departureAirport' => $departureAirport->getCode(),
            'arrivalAirport' => $arrivalAirport->getCode(),
            'departureDateTime' => ($shedule->getDepartureDatetime())->format('Y-m-d H:i:s'),
            'arrivalDateTime' => ($shedule->getArrivalDatetime())->format('Y-m-d H:i:s'),
            'duration' => $shedule->getDuration()
        );
    }
}
