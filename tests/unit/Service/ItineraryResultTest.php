<?php
namespace Service;

use Model\TicketModel;
use PHPUnit\Framework\TestCase;

class ItineraryResultTest extends TestCase
{
    public function test_compile_sorted_tickets()
    {
        $ticket1 = [
            TicketModel::DEPARTURE_FIELD => 'St. Anton am Arlberg Bahnhof',
            TicketModel::DESTINATION_FIELD => 'Innsbruck Hbf',
            TicketModel::TRANSPORTATION_TYPE_FIELD => 'train',
            TicketModel::TRANSPORTATION_CODE_FIELD => 'RJX 765',
            TicketModel::SEAT_CODE_FIELD => '17C',
            TicketModel::BOARDING_DETAILS_FIELD => 'Platform 3',
            TicketModel::EXTRA_DETAILS_FIELD => '',
        ];

        $ticket2 = [
            TicketModel::DEPARTURE_FIELD => 'Innsbruck Hbf',
            TicketModel::DESTINATION_FIELD => 'Innsbruck Airport',
            TicketModel::TRANSPORTATION_TYPE_FIELD => 'tram',
            TicketModel::TRANSPORTATION_CODE_FIELD => 'S5',
            TicketModel::SEAT_CODE_FIELD => '',
            TicketModel::BOARDING_DETAILS_FIELD => '',
            TicketModel::EXTRA_DETAILS_FIELD => '',
        ];

        $ticket3 = [
            TicketModel::DEPARTURE_FIELD => 'Innsbruck Airport',
            TicketModel::DESTINATION_FIELD => 'Venice Airport',
            TicketModel::TRANSPORTATION_TYPE_FIELD => 'flight',
            TicketModel::TRANSPORTATION_CODE_FIELD => 'AA904',
            TicketModel::SEAT_CODE_FIELD => '18B',
            TicketModel::BOARDING_DETAILS_FIELD => 'gate 10',
            TicketModel::EXTRA_DETAILS_FIELD => 'Self-check-in luggage at counter.',
        ];

        $ticket4 = [
            TicketModel::DEPARTURE_FIELD => 'Venice Airport',
            TicketModel::DESTINATION_FIELD => 'Gara Venetia Santa Lucia',
            TicketModel::TRANSPORTATION_TYPE_FIELD => 'tram',
            TicketModel::TRANSPORTATION_CODE_FIELD => 'A10',
            TicketModel::SEAT_CODE_FIELD => '',
            TicketModel::BOARDING_DETAILS_FIELD => '',
            TicketModel::EXTRA_DETAILS_FIELD => '',
        ];

        $ticket5 = [
            TicketModel::DEPARTURE_FIELD => 'Gara Venetia Santa Lucia',
            TicketModel::DESTINATION_FIELD => 'Bologna San Ruffillo',
            TicketModel::TRANSPORTATION_TYPE_FIELD => 'train',
            TicketModel::TRANSPORTATION_CODE_FIELD => 'ICN 35780',
            TicketModel::SEAT_CODE_FIELD => '13F',
            TicketModel::BOARDING_DETAILS_FIELD => 'Platform 1',
            TicketModel::EXTRA_DETAILS_FIELD => '',
        ];

        $ticket6 = [
            TicketModel::DEPARTURE_FIELD => 'Bologna San Ruffillo',
            TicketModel::DESTINATION_FIELD => 'Bologna Guglielmo Marconi Airport',
            TicketModel::TRANSPORTATION_TYPE_FIELD => 'airport bus',
            TicketModel::TRANSPORTATION_CODE_FIELD => '',
            TicketModel::SEAT_CODE_FIELD => '',
            TicketModel::BOARDING_DETAILS_FIELD => '',
            TicketModel::EXTRA_DETAILS_FIELD => '',
        ];

        $ticket7 = [
            TicketModel::DEPARTURE_FIELD => 'Bologna Guglielmo Marconi Airport',
            TicketModel::DESTINATION_FIELD => 'Paris CDG Airport',
            TicketModel::TRANSPORTATION_TYPE_FIELD => 'flight',
            TicketModel::TRANSPORTATION_CODE_FIELD => 'AF1229',
            TicketModel::SEAT_CODE_FIELD => '10A',
            TicketModel::BOARDING_DETAILS_FIELD => 'gate 22',
            TicketModel::EXTRA_DETAILS_FIELD => 'Self-check-in luggage at counter.',
        ];

        $ticket8 = [
            TicketModel::DEPARTURE_FIELD => 'Paris CDG Airport',
            TicketModel::DESTINATION_FIELD => "Chicago O'Hare",
            TicketModel::TRANSPORTATION_TYPE_FIELD => 'flight',
            TicketModel::TRANSPORTATION_CODE_FIELD => 'AF136',
            TicketModel::SEAT_CODE_FIELD => '10A',
            TicketModel::BOARDING_DETAILS_FIELD => 'gate 32',
            TicketModel::EXTRA_DETAILS_FIELD => 'Luggage will transfer automatically from the last flight.',
        ];

        $tickets = [5 => $ticket5, 3 => $ticket3, 1 => $ticket1, 2 => $ticket2, 7 => $ticket7, 4 => $ticket4, 8 => $ticket8, 6 => $ticket6];

        $itineraryResult = new ItineraryResult();
        $result = $itineraryResult->compileSortedTickets($tickets);

        $expectation = [
            0 => 'Start.',
            1 => 'From "St. Anton am Arlberg Bahnhof" board train - RJX 765 from Platform 3 to "Innsbruck Hbf". Seat number: 17C. Extra Details: No extra details provided',
            2 => 'From "Innsbruck Hbf" board tram - S5 from No boarding details provided to "Innsbruck Airport". Seat number: No seat assignment provided. Extra Details: No extra details provided',
            3 => 'From "Innsbruck Airport" board flight - AA904 from gate 10 to "Venice Airport". Seat number: 18B. Extra Details: Self-check-in luggage at counter.',
            4 => 'From "Venice Airport" board tram - A10 from No boarding details provided to "Gara Venetia Santa Lucia". Seat number: No seat assignment provided. Extra Details: No extra details provided',
            5 => 'From "Gara Venetia Santa Lucia" board train - ICN 35780 from Platform 1 to "Bologna San Ruffillo". Seat number: 13F. Extra Details: No extra details provided',
            6 => 'From "Bologna San Ruffillo" board airport bus - No transportation code provided from No boarding details provided to "Bologna Guglielmo Marconi Airport". Seat number: No seat assignment provided. Extra Details: No extra details provided',
            7 => 'From "Bologna Guglielmo Marconi Airport" board flight - AF1229 from gate 22 to "Paris CDG Airport". Seat number: 10A. Extra Details: Self-check-in luggage at counter.',
            8 => 'From "Paris CDG Airport" board flight - AF136 from gate 32 to "Chicago O\'Hare". Seat number: 10A. Extra Details: Luggage will transfer automatically from the last flight.',
            9=> 'Last destination reached.'
        ];

        $this->assertSame($expectation, $result);
    }
}
