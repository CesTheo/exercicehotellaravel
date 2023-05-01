<?php

namespace App\Services;

use App\Models\Location;

class LocationService
{
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

    
    public function createLocation($request){
        $newLocaltion = Location::create([
            'nom' => $request->nom,
            'description' => $request->description
        ]);
        return response()->json($newLocaltion, 200);
    }


    public function deleteLocation($request){
        $location = Location::findOrFail($request->id)->delete();
        return response()->json($location, 200);
    }

    public function modifyLocation($request){
        $location = Location::findOrFail($request->id);
        $location->nom = $request->nom;
        $location->description = $request->description;
        $location->save();
        return response()->json($location, 200);
    }
}
