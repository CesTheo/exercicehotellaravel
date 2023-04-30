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
        $locations = Location::with('categories')->get();
        if($locations){
            return response()->json($locations, 200);
        }else {
            return response()->json(['error' => 'Ressource non trouvée'], 404);
        }
    }

    public function getById(int $id){
        $location = Location::with('categories')->get()->find($id);
         if($location){
            return response()->json($location);
         }else{
            return response()->json(['error' => 'Ressource non trouvée'], 404);
         }
    }
}
