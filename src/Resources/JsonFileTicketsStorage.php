<?php

namespace Resources;

class JsonFileTicketsStorage
{
    public function fetchAllTicketsData()
    {
        $jsonContents = file_get_contents('tickets.json');

        return json_decode($jsonContents, true);
    }
}
