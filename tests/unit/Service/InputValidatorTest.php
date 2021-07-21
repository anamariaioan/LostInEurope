<?php

namespace Service;

use Model\TicketModel;
use PHPUnit\Framework\TestCase;

class InputValidatorTest extends TestCase
{
    public function test_validate_lis_of_tickets_empty_input()
    {
        $input = [[]];
        $inputValidator = new InputValidator();

        $result = $inputValidator->validateListOfTickets($input);

        $this->assertSame([
                TicketModel::TRANSPORTATION_TYPE_FIELD,
                TicketModel::DEPARTURE_FIELD,
                TicketModel::DESTINATION_FIELD
            ],
            $result);
    }

    public function test_validate_lis_of_tickets_invalid_input()
    {
        $input = [
            [
                'aa',
                'bb'
            ],
            [
                TicketModel::TRANSPORTATION_TYPE_FIELD
            ]
        ];
        $inputValidator = new InputValidator();

        $result = $inputValidator->validateListOfTickets($input);

        $this->assertSame(['transportation_type', 'departure', 'destination'], $result);
    }

    public function test_validate_list_of_tickets_valid_input()
    {
        $input = [
            [
                TicketModel::TRANSPORTATION_TYPE_FIELD => 'train',
                TicketModel::DEPARTURE_FIELD => 'Bucuresti',
                TicketModel::DESTINATION_FIELD => 'Budapest'
            ],
            [
                TicketModel::TRANSPORTATION_TYPE_FIELD => 'flight',
                TicketModel::DEPARTURE_FIELD => 'Sofia',
                TicketModel::DESTINATION_FIELD => 'Bucuresti',
                TicketModel::BOARDING_DETAILS_FIELD => 'gate 22',
                TicketModel::TRANSPORTATION_CODE_FIELD => 'AF136',
                TicketModel::SEAT_CODE_FIELD => '10A',
                TicketModel::EXTRA_DETAILS_FIELD => 'Luggage will transfer automatically from the last flight.'
            ]
        ];
        $inputValidator = new InputValidator();

        $result = $inputValidator->validateListOfTickets($input);

        $this->assertSame(true, $result);
    }
}
