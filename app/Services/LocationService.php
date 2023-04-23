<?php

namespace App\Services;

use App\Models\Location;

class LocationService
{
    public function DebugTests()
    {
        return "LocationService";
    }

    public function getAll(){
        $locations = Location::all();
        return $locations;
    }
}
