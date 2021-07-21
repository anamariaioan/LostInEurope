<?php

namespace Service;

use JetBrains\PhpStorm\Pure;
use Model\TicketModel;

trait LocationIteratorTrait
{
    #[Pure] public function getDepartureLocations($tickets): array
    {
        $departureLocations = [];
        /** @var TicketModel $ticket */
        foreach ($tickets as $ticket) {
            $departureLocations[] = $ticket->getDeparture();
        }

        return $departureLocations;
    }

    #[Pure] private function getArrivalLocations($tickets): array
    {
        $arrivalLocations = [];
        /** @var TicketModel $ticket */
        foreach ($tickets as $ticket) {
            $arrivalLocations[] = $ticket->getDestination();
        }

        return $arrivalLocations;
    }
}