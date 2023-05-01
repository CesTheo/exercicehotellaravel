<?php

namespace App\Http\Controllers;

use App\Services\CategorieService;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    protected $categorieService;

    public function __construct(CategorieService $categorieService){
        $this->categorieService = $categorieService;
    }

    public function create(Request $request){
        return $this->categorieService->create($request);
    }

    public function delete(Request $request){
        return $this->categorieService->delete($request);
    }

    public function AddToLocation(Request $request){
        return $this->categorieService->AddToLocation($request);
    }

    public function getLocationsByCategorie(Request $request){
        return $this->categorieService->getLocationsByCategorie($request);
    }

    public function getLocationsByCategories(Request $request){
        return $this->categorieService->getLocationsByCategories($request);
    }

    public function getAllCategories(){
        return $this->categorieService->getAllCategories();
    }

    public function resetCategorieToLocation(Request $request){
        return $this->categorieService->resetCategorieToLocation($request);
    }
}
