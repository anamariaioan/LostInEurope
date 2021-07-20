<?php

namespace Controller;

use Service\SortTicketsService;

class ApiController extends SortTicketsService
{
    private $requestMethod;

    public function __construct($requestMethod)
    {
        parent::__construct();
        $this->requestMethod = $requestMethod;
    }

    public function processRequest()
    {
        switch ($this->requestMethod) {
            case 'GET':
                $response = $this->getAllTickets();
                break;
        }

        header($response['status_code_header']);
        if ($response['body']) {
            echo $response['body'];
        }
    }

    private function getAllTickets()
    {
        $result = $this->sortTickets();
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }
}
