<?php

namespace App\Services;

use App\Models\Location;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class ReservationService
{
    public function createReservation($request){
        $location = Location::find($request->id_location);
        $dateDebut = Carbon::parse($request->datedebut);
        $dateFin = Carbon::parse($request->datefin);
        if($dateDebut->isBefore($dateFin)){
            $daysBetween = $dateDebut->diffInDays($dateFin);
            if($daysBetween >= 1 && $daysBetween <= 30){
                if($this->checkDateConflict($request->datedebut, $request->datefin, $location->id)){
                    $reservation = Reservation::create([
                        'location_id' => $location->id,
                        'start_at' => $dateDebut,
                        'end_at' => $dateFin,
                        'user_id' => Auth::guard('sanctum')->user()->id,
                    ]);
                    return response()->json([
                        "Success" => true,
                        "Reservations" => $reservation,
                    ], 200
                    );
                }else{
                    return response()->json(['error' => 'La date est déja selectionné'], 400);
                }
            }else{
                return response()->json(['error' => 'La date de la réservation est trop long ou trop courte'], 400);
            }
        }else{
            return response()->json(['error' => 'L\'ordre des dates n\'est pas bon'], 400);
        }
    }

    public function checkDateConflict($start, $end, $locationId)
    {
        $start = Carbon::parse($start);
        $end = Carbon::parse($end);

        $conflictingReservations = Reservation::where(function ($query) use ($start, $end) {
            $query->whereBetween('start_at', [$start, $end])
                ->orWhereBetween('end_at', [$start, $end])
                ->orWhere(function ($query) use ($start, $end) {
                    $query->where('start_at', '<=', $start)
                        ->where('end_at', '>=', $end);
                });
        })
        ->where('location_id', $locationId)
        ->get();

        if ($conflictingReservations->count() > 0) {
            return false;
        }
        return true;
    }

    public function deleteReservation($request){
        //Vérification de la reservation existe bien
        $reservation = Reservation::find($request->id);
        if($reservation){
            //Vérification de la reservation appartien bien a l'user connecter
            if($reservation->user_id === Auth::guard('sanctum')->user()->id || Auth::guard('sanctum')->user()->admin){
                $reservation->delete();
                return response()->json(["La réservation a bien était supprimé"], 200);
            }else{
                return response()->json(['error' => 'Pas autorisé'], 401);
            }
        }
        else{
            return response()->json(['error' => 'Ressources non trouvée'], 404);
        }

    }
}