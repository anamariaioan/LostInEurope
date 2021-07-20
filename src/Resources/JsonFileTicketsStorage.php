<?php

namespace Resources;

class JsonFileTicketsStorage
{
    public function fetchAllShipsData()
    {
        $jsonContents = file_get_contents('tickets.json');

        return json_decode($jsonContents, true);
    }
}
