<?php

namespace Service;

use Model\TicketModel;
use JetBrains\PhpStorm\Pure;

class SortTicketsService
{
    private array $tickets;

    public function __construct($tickets)
    {
        $this->tickets = $tickets;
    }

    #[Pure] private function getDepartureLocations(): array
    {
        $departureLocations = [];
        /** @var TicketModel $ticket */
        foreach ($this->tickets as $ticket) {
            $departureLocations[] = $ticket->getDeparture();
        }

        return $departureLocations;
    }

    #[Pure] private function getArrivalLocations(): array
    {
        $arrivalLocations = [];
        /** @var TicketModel $ticket */
        foreach ($this->tickets as $ticket) {
            $arrivalLocations[] = $ticket->getDestination();
        }

        return $arrivalLocations;
    }

    #[Pure] private function getStartingPoint(): array
    {
        return array_diff($this->getDepartureLocations(), $this->getArrivalLocations());
    }

    private function decideNextTicket($departure)
    {
        $nextTicket = null;

        /** @var TicketModel $ticket */
        foreach ($this->tickets as $ticket) {
            if ($ticket->getDeparture() === $departure) {
                $nextTicket = $ticket;
            }
        }

        return $nextTicket;
    }

    #[Pure] protected function sortTickets(): array
    {
        $ticketsCount = count($this->tickets);
        $startingPoint = $this->getStartingPoint();
        $sortedTickets[] = $this->decideNextTicket(current($startingPoint));

        for ($i = 1; $i < $ticketsCount; $i++) {
            $lastTicket = $sortedTickets[$i-1];
            if ($lastTicket instanceof TicketModel) {
                $sortedTickets[$i] = $this->decideNextTicket($lastTicket->getDestination());
            }
        }

        return $sortedTickets;
    }
}
