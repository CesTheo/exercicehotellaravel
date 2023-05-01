<?php

namespace App\Services;

use App\Models\Categorie;
use App\Models\Location;

class CategorieService
{
    public function create($request){
        $newCategorie = Categorie::create([
            'nom' => $request->name,
        ]);
        return response()->json([$newCategorie]);
    }

    public function delete($request){
        $categorie = Categorie::findOrFail($request->id);
    
        $categorie->delete();
    
        return response()->json(['message' => 'Catégorie supprimée avec succès']);
    }

    public function AddToLocation($request){
        $id_location = $request->id_location;
        $id_categorie = $request->id_categorie;

        $location = Location::findOrFail($id_location);

        $location->categories()->attach($id_categorie);

        return response()->json(['message' => 'Catégorie ajoutée à la location avec succès']);
    }

    public function getLocationsByCategorie($request){
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

    public function getLocationsByCategories($request){
        $categorieIds = $request->categorie_ids;

        $locations = Location::whereHas('categories', function ($query) use ($categorieIds) {
            $query->whereIn('categorie_id', $categorieIds);
        }, '=', count($categorieIds))->get();
    
        return response()->json($locations);
    }

    public function getAllCategories(){
        return response()->json(Categorie::all());
    }

    public function resetCategorieToLocation($request){
        $location = Location::findOrFail($request->id);
        $location->categories()->detach();
        return response()->json(['message' => 'Toutes les catégories ont été supprimées de la location avec succès']);
    }
}
