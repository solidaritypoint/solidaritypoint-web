<?php
declare(strict_types=1);

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\DriverHasRefugee;
use App\Models\Refugee;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\App;

class DriverHomeController extends Controller
{
    public function create(string $locale): Factory|View|Application
    {
        $driverId = Driver::where('user_id', auth()->user()->id)->first()->id ?? null;
        $confirmedOffers = DriverHasRefugee::where('driver_id', $driverId)->where("status", "confirmed")->count();
        $acceptedOffers = DriverHasRefugee::where('driver_id', $driverId)->where("status", "accepted")->count();
        $offeredOffers = DriverHasRefugee::where('driver_id', $driverId)->where("status", "offered")->count();
        $seats = Driver::where("id",$driverId)->first()->seats;

        $offers = DriverHasRefugee::where('driver_id', $driverId)
            ->where("status", "accepted")
            ->with("refugee")
            ->with("refugee.refugee_companions")
            ->get();

        $reservedSeats = 0;
        foreach(collect($offers)->toArray() as $offer) {
            $reservedSeats++;
            $reservedSeats += count($offer["refugee"]["refugee_companions"]);
        }

        return view('driver.home', [
            "confirmed_offers" => $confirmedOffers,
            "accepted_offers" => $acceptedOffers,
            "offered_offers" => $offeredOffers,
            "seats" => $seats,
            "reserved_seats" => $reservedSeats
        ]);
    }
}
