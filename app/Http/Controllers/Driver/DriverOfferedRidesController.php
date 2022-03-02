<?php
declare(strict_types=1);

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\DriverHasRefugee;
use App\Models\PlaceOfDeparture;
use App\Models\Refugee;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class DriverOfferedRidesController extends Controller
{
    public function create() {

        $driverId = Driver::where('user_id', auth()->user()->id)->first()->id ?? null;

        // HOTFIX
        $offers = [];
        foreach(DriverHasRefugee::where('driver_id', $driverId)->get() as $index => $driverHasRefugee) {
            $offers[$index] = Refugee::where('id',$driverHasRefugee->refugee_id)->with('user')
                ->with('refugee_companions')
                ->with("place_of_departure")
                ->with('drivers')
                ->orderByRaw("FIELD('accepted' , 'confirmed', 'offered', 'rejected','canceled') ASC")->first();
        }
//        !! This doesnt work !!
//        $offers = Refugee::with('user')->with('refugee_companions')->with("drivers")->with("place_of_departure")
//            ->whereHas('drivers', function (Builder $query) use($driverId) {
//                $query->where('driver_id', $driverId);
//            })->orderByRaw("FIELD('accepted' , 'confirmed', 'offered', 'rejected','canceled') ASC")->get();

        $freeSeats = Driver::where("id",$driverId)->first()->seats;
        $acceptedOffers = DriverHasRefugee::where('driver_id', $driverId)
            ->where("status", "accepted")
            ->with("refugee")
            ->with("refugee.refugee_companions")
            ->get();

        foreach(collect($acceptedOffers)->toArray() as $offer) {
            $freeSeats--;
            $freeSeats -= count($offer["refugee"]["refugee_companions"]);
        }

        return view('driver.offered_rides',[
            'refugees' => collect($offers)->toArray(),
            "free_seats" => $freeSeats,
        ]);
    }

    public function changeOfferStatus(Request $request) {
        $driverId = Driver::where('user_id', auth()->user()->id)->first()->id ?? null;

        if(($offer = DriverHasRefugee::where("id",$request->offer_id)->where('driver_id', $driverId)->first()) == null) {
            return redirect(app()->getLocale() . '/driver/offered_rides')->with('error', 'Error');
        }

        // např. accepted smí být tehdy, kdy je nabídka offered
        $statusComb = [
            "accepted" => ["confirmed"],
            "rejected"=> ["confirmed"],
            "canceled"=> ["offered","accepted"],
        ];
        if(isset($statusComb[$request->status]) && in_array($offer->status,$statusComb[$request->status])) {
            if($offer->status == "offered" && $request->status == "canceled") {
                $offer->delete();
            } else {
                $offer->status = $request->status;
                $offer->save();
            }
        }
        return redirect(app()->getLocale() . '/driver/offered_rides')->with('success', 'Success');
    }
}
