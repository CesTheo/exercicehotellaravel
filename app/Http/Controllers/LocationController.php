<?php

namespace App\Http\Controllers;

use App\Services\LocationService;
use Illuminate\Http\Request;

class LocationController extends Controller
{

    protected $locationService;

    public function __construct(LocationService $locationService){
        $this->locationService = $locationService;
    }

    public function getAll(){
        return $this->locationService->getAll();
    }

    public function getById(Request $request){
        return $this->locationService->getById($request->id);
    }

    public function createLocation(Request $request){
        return $this->locationService->createLocation($request);
    }


    public function deleteLocation(Request $request){
        return $this->locationService->deleteLocation($request);
    }

    public function modifyLocation(Request $request){
        return $this->locationService->modifyLocation($request);
    }
}
