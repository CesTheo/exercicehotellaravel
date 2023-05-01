<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //Controller test pour crée des fake identifiants
    public function index(){
        User::create([
            'prenom' => 'Théo',
            'nom' => 'Maudet',
            'email' => 'theo.maudet@icloud.com',
            'password' => Hash::make('theo'),
        ]);

        User::create([
            'prenom' => 'admin',
            'nom' => 'admin',
            'email' => 'admin@icloud.com',
            'admin' => true,
            'password' => Hash::make('admin'),
        ]);
        return 'user de base test prét';
    }
}
