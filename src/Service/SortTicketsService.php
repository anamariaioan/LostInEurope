<?php

namespace Service;

use Model\TicketModel;
use JetBrains\PhpStorm\Pure;

class SortTicketsService
{
    use LocationIteratorTrait;

    private array $tickets;

    private TicketModel $ticketModel;

    public function __construct()
    {
        $this->ticketModel = new TicketModel();
    }

    #[Pure] private function getStartingPoint(): array
    {
        return array_diff($this->getDepartureLocations($this->tickets), $this->getArrivalLocations($this->tickets));
    }

    #[Pure] private function decideNextTicket($departure)
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

    #[Pure] public function getSortedTickets(array $tickets): array
    {
        $this->tickets = $tickets;
        $ticketsCount = count($tickets);

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
