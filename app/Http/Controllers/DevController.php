<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DevController extends Controller
{
    public function index (){
        $mutable = Carbon::now();
        $datetime = $mutable->toDateTimeString();
        dd($datetime);
    }
    
    public function creationlocation () {
        Location::create([
            'nom' => 'Camping 1',
            'description' => 'Ceci est une super derscription sur un camping'
        ]);
    }
}
