<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $loginRequest){

        //Vérification si l'user est valide et que les informations sont bonnes
        if(Auth::attempt($loginRequest->validated())){
            // On récuperer l'utilisateur associés par l'email qui est unique
            $user = User::where('email', $loginRequest->email)->first();
            // Génération du token valable 1 heures
            $token = $user->createToken('auth_token')->plainTextToken;
            // Envoie de l'informations
            return response()->json([
                'user' => $user,
                'access_token' => $token 
            ]);
        }
        // Erreur
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function currentUser(Request $request){
        //Avoir l'information sur les utilisateurs
        return $request->user();
    }

    public function destroyToken(Request $request){
        //Suppresion des tokens
        $request->user()->tokens()->delete();
        //Message
        return response()->json(['message' => 'Tokens supprimer']);
    }
}
