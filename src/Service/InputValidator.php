<?php

namespace Service;

use JetBrains\PhpStorm\Pure;
use Model\TicketModel;

class InputValidator
{
    use LocationIteratorTrait;

    protected array $listOfMandatoryKeys = [
        TicketModel::TRANSPORTATION_TYPE_FIELD,
        TicketModel::DEPARTURE_FIELD,
        TicketModel::DESTINATION_FIELD,
    ];

    public function validateListOfTickets(array $input)
    {
        if (empty($input)) {
            return $this->listOfMandatoryKeys;
        }

        foreach ($input as $item) {
            $fields = array_keys($item);
            $missingFields = array_diff($this->listOfMandatoryKeys, $fields);
            if (empty($missingFields)) {
                return true;
            }
        }
        return $missingFields;
    }

    #[Pure] public function validateMultipleLocations($tickets)
    {
        $multipleDepartures = $this->multipleLocationsValidator(array_count_values($this->getDepartureLocations($tickets)));
        if ($multipleDepartures) {
            return ['departure' => $multipleDepartures];
        }

        $multipleArrivals = $this->multipleLocationsValidator(array_count_values($this->getArrivalLocations($tickets)));
        if ($multipleArrivals) {
            return ['arrival' => $multipleArrivals];
        }

        return true;
    }

    private function multipleLocationsValidator($locationsUniqueCountArray)
    {
        foreach ($locationsUniqueCountArray as $key => $departureCount) {
            if ($departureCount > 1) {
                return $key;
            }
        }
        return false;
    }
}
