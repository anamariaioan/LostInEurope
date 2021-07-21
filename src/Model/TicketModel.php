<?php
namespace Model;

class TicketModel
{
    const TRANSPORTATION_TYPE_FIELD = 'transportation_type';
    const DEPARTURE_FIELD = 'departure';
    const DESTINATION_FIELD = 'destination';
    const TRANSPORTATION_CODE_FIELD = 'transportation_code';
    const BOARDING_DETAILS_FIELD = 'boarding_details';
    const SEAT_CODE_FIELD = 'seat_code';
    const EXTRA_DETAILS_FIELD = 'extra_details';

    private string $transportationCode;

    private string $transportationType;

    private string $departure;

    private string $boardingDetails;

    private string $destination;

    private string $seatCode;

    private string $extraDetails;

    public function getTransportationCode(): string
    {
        return $this->transportationCode ?: "No transportation code provided";
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
        return $this->boardingDetails ?: "No boarding details provided";
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
        return $this->seatCode ?: 'No seat assignment provided';
    }

    public function setSeatCode(string $seatCode)
    {
        $this->seatCode = $seatCode;
    }

    public function getExtraDetails(): string
    {
        return $this->extraDetails ?: 'No extra details provided';
    }

    public function setExtraDetails(string $extraDetails)
    {
        $this->extraDetails = $extraDetails;
    }

    public function getArrayOfTicketsObject(array $tickets): array
    {
        $arrayOfTicketsObject = [];

        foreach ($tickets as $ticket) {
            $ticketObject = new TicketModel();
            $ticketObject->setTransportationType($ticket[self::TRANSPORTATION_TYPE_FIELD]);
            $ticketObject->setDeparture($ticket[self::DEPARTURE_FIELD]);
            $ticketObject->setDestination($ticket[self::DESTINATION_FIELD]);
            $ticketObject->setTransportationCode($ticket[self::TRANSPORTATION_CODE_FIELD] ?? '');
            $ticketObject->setBoardingDetails($ticket[self::BOARDING_DETAILS_FIELD] ?? '');
            $ticketObject->setSeatCode($ticket[self::SEAT_CODE_FIELD . ''] ?? '');
            $ticketObject->setExtraDetails($ticket[self::EXTRA_DETAILS_FIELD] ?? '');

            $arrayOfTicketsObject[] = $ticketObject;
        }
        return $arrayOfTicketsObject;
    }
}
