<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Services\LocationService;
use Illuminate\Http\Request;

class LocationController extends Controller
{

    protected $locationService;

    public function __construct(LocationService $locationService)
    {
        $this->locationService = $locationService;
    }

    public function getAll(){
        return $this->locationService->getAll();
    }

    public function getById(Request $request){
        return $this->locationService->getById($request->id);
    }

    public function createLocation(Request $request){
        $newLocaltion = Location::create([
            'nom' => $request->nom,
            'description' => $request->description
        ]);

        dd($newLocaltion);
    }


    public function deleteLocation(Request $request){
        $location = Location::find($request->id)->delete();
        dd($location);
    }
}
