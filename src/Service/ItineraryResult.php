<?php

namespace Service;

use Model\TicketModel;
use JetBrains\PhpStorm\Pure;

class ItineraryResult extends SortTicketsService
{
    const START = 'Start.';
    const FINISH = 'Last destination reached.';

    #[Pure] public function compileSortedTickets(): array
    {
        $itinerary[] = self::START;

        /** @var TicketModel $ticket */
        foreach ($this->sortTickets() as $ticket) {
            $itinerary[] =
                'From "' . $ticket->getDeparture() .
                '" board ' . $ticket->getTransportationType() .
                ' - ' . $ticket->getTransportationCode() .
                ' from ' . $ticket->getBoardingDetails() .
                ' to "' . $ticket->getDestination() .
                '". Seat number: ' . $ticket->getSeatCode() .
                '. Extra Details: ' . $ticket->getExtraDetails();
        }
        $itinerary[] = self::FINISH;

        return $itinerary;
    }
}
