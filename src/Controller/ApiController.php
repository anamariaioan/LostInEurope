<?php

namespace Controller;

use JetBrains\PhpStorm\Pure;
use Model\TicketModel;
use Service\InputValidator;
use Service\ItineraryResult;

class ApiController extends InputValidator
{
    private string $requestMethod;
    private ItineraryResult $itineraryResult;
    private TicketModel $ticketModel;

    #[Pure] public function __construct($requestMethod)
    {
        $this->itineraryResult = new ItineraryResult();
        $this->ticketModel = new TicketModel();
        $this->requestMethod = $requestMethod;
    }

    public function processRequest()
    {
        switch ($this->requestMethod) {
            case 'POST':
                $response = $this->returnSortedTickets();
                break;
        }

        if ($response['body']) {
            echo $response['body'];
        }
    }

    private function returnSortedTickets(): array
    {
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);

        if (current($input) == 'Are you a teapot?') {
            return $this->iAmTeapot();
        }

        $validatorResult = $this->validateListOfTickets($input);
        if (is_array($validatorResult)) {
            return $this->unprocessableEntityResponse($validatorResult);
        }

        $convertedInput =$this->ticketModel->getArrayOfTicketsObject($input);

        $validateLocationsResult = $this->validateMultipleLocations($convertedInput);

        if (is_array($validateLocationsResult)) {
            return $this->badRequestResponse($validateLocationsResult);
        }

        $result = $this->itineraryResult->compileSortedTickets($convertedInput);
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    private function unprocessableEntityResponse($missingFields): array
    {
        $error = 'Invalid input. Missing field/fields:';
        foreach ($missingFields as $field) {
            $error .= "\n " . $field;
        }

        $response['status_code_header'] = 'HTTP/1.1 422 Unprocessable Entity';
        $response['body'] = json_encode([
            'error' => $error,
        ]);
        return $response;
    }

    private function badRequestResponse($validateLocationsResult): array
    {
        $error = 'There are multiple tickets with the same ' . array_key_first($validateLocationsResult) .
            ' location: ' . array_pop($validateLocationsResult);

        $response['status_code_header'] = 'HTTP/1.1 400 Bad Request';
        $response['body'] = json_encode([
            'error' => $error,
        ]);
        return $response;
    }

    private function iAmTeapot(): array
    {
        $response['status_code_header'] = 'HTCPCP/1.0 418 I\'m a teapot';
        $response['body'] = json_encode([
            'error' => 'Yes, I am.',
        ]);
        return $response;
    }
}
