<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Location;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function create(Request $request){
        $newCategorie = Categorie::create([
            'nom' => $request->name,
        ]);
        dd($newCategorie);
    }

    public function AddToLocation(Request $request){
        $id_location = $request->id_location;
        $id_categorie = $request->id_categorie;

        $location = Location::findOrFail($id_location);

        $location->categories()->attach($id_categorie);

        return response()->json(['message' => 'Catégorie ajoutée à la location avec succès']);
    }

    public function getLocationsByCategorie(Request $request){
        $categorieId = $request->id;

        $categorie = Categorie::where('id', $categorieId)->first();

        if (!$categorie) {
            return response()->json(['message' => 'Catégorie non trouvée'], 404);
        }

        $locations = Location::whereHas('categories', function ($query) use ($categorie) {
            $query->where('categorie_id', $categorie->id);
        })->get();

        return response()->json($locations);
    }

    public function getLocationsByCategories(Request $request){
        $categorieIds = $request->categorie_ids;

        $locations = Location::whereHas('categories', function ($query) use ($categorieIds) {
            $query->whereIn('categorie_id', $categorieIds);
        }, '=', count($categorieIds))->get();
    
        return response()->json($locations);
    
    }
}
