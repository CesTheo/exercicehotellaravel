<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Services\ReservationService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{

    protected $reservationService;

    public function __construct(ReservationService $reservationService){
        $this->reservationService = $reservationService;
    }

    public function create(Request $request){
        return $this->reservationService->createReservation($request);
    }

    public function delete(Request $request){
        return $this->reservationService->deleteReservation($request);
    }


}
