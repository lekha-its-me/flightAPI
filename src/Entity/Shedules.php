<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ShedulesRepository")
 */
class Shedules
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $transporter_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $flight_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $departure_airport_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $arrival_airport_id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $departure_datetime;

    /**
     * @ORM\Column(type="datetime")
     */
    private $arrival_datetime;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $duration;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTransporterId(): ?int
    {
        return $this->transporter_id;
    }

    public function setTransporterId(int $transporter_id): self
    {
        $this->transporter_id = $transporter_id;

        return $this;
    }

    public function getFlightId(): ?int
    {
        return $this->flight_id;
    }

    public function setFlightId(int $flight_id): self
    {
        $this->flight_id = $flight_id;

        return $this;
    }

    public function getDepartureAirportId(): ?int
    {
        return $this->departure_airport_id;
    }

    public function setDepartureAirportId(int $departure_airport_id): self
    {
        $this->departure_airport_id = $departure_airport_id;

        return $this;
    }

    public function getArrivalAirportId(): ?int
    {
        return $this->arrival_airport_id;
    }

    public function setArrivalAirportId(int $arrival_airport_id): self
    {
        $this->arrival_airport_id = $arrival_airport_id;

        return $this;
    }

    public function getDepartureDatetime(): ?\DateTimeInterface
    {
        return $this->departure_datetime;
    }

    public function setDepartureDatetime(\DateTimeInterface $departure_datetime): self
    {
        $this->departure_datetime = $departure_datetime;

        return $this;
    }

    public function getArrivalDatetime(): ?\DateTimeInterface
    {
        return $this->arrival_datetime;
    }

    public function setArrivalDatetime(\DateTimeInterface $arrival_datetime): self
    {
        $this->arrival_datetime = $arrival_datetime;

        return $this;
    }

    public function getDuration(): ?string
    {
        return $this->duration;
    }

    public function setDuration(string $duration): self
    {
        $this->duration = $duration;

        return $this;
    }
}
