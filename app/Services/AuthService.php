<?php

namespace App\Services;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthService
{
    public function login($loginRequest){
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

    //Avoir info user 
    public function getUser($request){
        return $request->user();
    }

    public function destroyToken($request){
        //Suppresion des tokens
        $request->user()->tokens()->delete();
        //Message
        return response()->json(['message' => 'Tokens supprimer']);
    }

    public function isLogin(){
        //Vérifie la connexion
        if(Auth::guard('sanctum')->check()){
            return response()->json("true");
        }else{
            return response()->json("false");
        }
    }
}
