<?php
namespace Model;

class TicketModel
{
    private string $transportationCode;

    private string $transportationType;

    private string $departure;

    private string $boardingDetails;

    private string $destination;

    private string $seatCode;

    private string $extraDetails;

    public function getTransportationCode(): string
    {
        return $this->transportationCode;
    }

    public function setTransportationCode(string $transportationCode)
    {
        $this->transportationCode = $transportationCode;
    }

    public function getTransportationType(): string
    {
        return $this->transportationType;
    }

    public function setTransportationType(string $transportationType)
    {
        $this->transportationType = $transportationType;
    }

    public function getDeparture(): string
    {
        return $this->departure;
    }

    public function setDeparture(string $departure)
    {
        $this->departure = $departure;
    }

    public function getBoardingDetails(): string
    {
        return $this->boardingDetails;
    }

    public function setBoardingDetails(string $boardingDetails)
    {
        $this->boardingDetails = $boardingDetails;
    }

    public function getDestination(): string
    {
        return $this->destination;
    }

    public function setDestination(string $destination)
    {
        $this->destination = $destination;
    }

    public function getSeatCode(): string
    {
        return $this->seatCode ?: 'No seat assignment';
    }

    public function setSeatCode(string $seatCode)
    {
        $this->seatCode = $seatCode;
    }

    public function getExtraDetails(): string
    {
        return $this->extraDetails ?: 'No extra details.';
    }

    public function setExtraDetails(string $extraDetails)
    {
        $this->extraDetails = $extraDetails;
    }
}
