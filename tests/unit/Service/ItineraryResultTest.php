<?php
namespace Service;

use Model\TicketModel;
use PHPUnit\Framework\TestCase;

class ItineraryResultTest extends TestCase
{
    public function testCompileSortedTickets()
    {
        $ticket1 = new TicketModel();
        $ticket1->setExtraDetails('');
        $ticket1->setDeparture('St. Anton am Arlberg Bahnhof');
        $ticket1->setDestination('Innsbruck Hbf');
        $ticket1->setTransportationType('train');
        $ticket1->setTransportationCode('RJX 765');
        $ticket1->setBoardingDetails('Platform 3');
        $ticket1->setSeatCode('17C');

        $ticket2 = new TicketModel();
        $ticket2->setExtraDetails('');
        $ticket2->setDeparture('Innsbruck Hbf');
        $ticket2->setDestination('Innsbruck Airport');
        $ticket2->setTransportationType('tram');
        $ticket2->setTransportationCode('S5');
        $ticket2->setBoardingDetails('');
        $ticket2->setSeatCode('');

        $ticket3 = new TicketModel();
        $ticket3->setExtraDetails('Self-check-in luggage at counter.');
        $ticket3->setDeparture('Innsbruck Airport');
        $ticket3->setDestination('Venice Airport');
        $ticket3->setTransportationType('flight');
        $ticket3->setTransportationCode('AA904');
        $ticket3->setBoardingDetails('gate 10');
        $ticket3->setSeatCode('18B');

        $ticket4 = new TicketModel();
        $ticket4->setExtraDetails('');
        $ticket4->setDeparture('Venice Airport');
        $ticket4->setDestination('Gara Venetia Santa Lucia');
        $ticket4->setTransportationType('tram');
        $ticket4->setTransportationCode('A10');
        $ticket4->setBoardingDetails('');
        $ticket4->setSeatCode('');

        $ticket5 = new TicketModel();
        $ticket5->setExtraDetails('');
        $ticket5->setDeparture('Gara Venetia Santa Lucia');
        $ticket5->setDestination('Bologna San Ruffillo');
        $ticket5->setTransportationType('train');
        $ticket5->setTransportationCode('ICN 35780');
        $ticket5->setBoardingDetails('Platform 1');
        $ticket5->setSeatCode('13F');

        $ticket6 = new TicketModel();
        $ticket6->setExtraDetails('');
        $ticket6->setDeparture('Bologna San Ruffillo');
        $ticket6->setDestination('Bologna Guglielmo Marconi Airport');
        $ticket6->setTransportationType('airport bus');
        $ticket6->setTransportationCode('');
        $ticket6->setBoardingDetails('');
        $ticket6->setSeatCode('');

        $ticket7 = new TicketModel();
        $ticket7->setExtraDetails('Self-check-in luggage at counter.');
        $ticket7->setDeparture('Bologna Guglielmo Marconi Airport');
        $ticket7->setDestination('Paris CDG Airport');
        $ticket7->setTransportationType('flight');
        $ticket7->setTransportationCode('AF1229');
        $ticket7->setBoardingDetails('gate 22');
        $ticket7->setSeatCode('10A');

        $ticket8 = new TicketModel();
        $ticket8->setExtraDetails('Luggage will transfer automatically from the last flight.');
        $ticket8->setDeparture('Paris CDG Airport');
        $ticket8->setDestination("Chicago O'Hare");
        $ticket8->setTransportationType('flight');
        $ticket8->setTransportationCode('AF136');
        $ticket8->setBoardingDetails('gate 32');
        $ticket8->setSeatCode('10A');

        $tickets = [5 => $ticket5, 3 => $ticket3, 1 => $ticket1, 2 => $ticket2, 7 => $ticket7, 4 => $ticket4, 8 => $ticket8, 6 => $ticket6];

        $itineraryResult = new ItineraryResult($tickets);
        $result = $itineraryResult->compileSortedTickets();

        $expectation = [
            0 => 'Start.',
            1 => 'From "St. Anton am Arlberg Bahnhof" board train - RJX 765 from Platform 3 to "Innsbruck Hbf". Seat number: 17C. Extra Details: No extra details.',
            2 => 'From "Innsbruck Hbf" board tram - S5 from  to "Innsbruck Airport". Seat number: No seat assignment. Extra Details: No extra details.',
            3 => 'From "Innsbruck Airport" board flight - AA904 from gate 10 to "Venice Airport". Seat number: 18B. Extra Details: Self-check-in luggage at counter.',
            4 => 'From "Venice Airport" board tram - A10 from  to "Gara Venetia Santa Lucia". Seat number: No seat assignment. Extra Details: No extra details.',
            5 => 'From "Gara Venetia Santa Lucia" board train - ICN 35780 from Platform 1 to "Bologna San Ruffillo". Seat number: 13F. Extra Details: No extra details.',
            6 => 'From "Bologna San Ruffillo" board airport bus -  from  to "Bologna Guglielmo Marconi Airport". Seat number: No seat assignment. Extra Details: No extra details.',
            7 => 'From "Bologna Guglielmo Marconi Airport" board flight - AF1229 from gate 22 to "Paris CDG Airport". Seat number: 10A. Extra Details: Self-check-in luggage at counter.',
            8 => 'From "Paris CDG Airport" board flight - AF136 from gate 32 to "Chicago O\'Hare". Seat number: 10A. Extra Details: Luggage will transfer automatically from the last flight.',
            9=> 'Last destination reached.'
        ];
        print_r($result);

        $this->assertSame($expectation, $result);
    }
}
