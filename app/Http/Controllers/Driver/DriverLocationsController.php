<?php
declare(strict_types=1);

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\Refugee;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;

class DriverLocationsController extends Controller
{

    public function create(string $locale): Factory|View|Application
    {
        $driverId = Driver::where('user_id', auth()->user()->id)->first()->id ?? null;
        foreach (Refugee::selectRaw('place_of_departure_id, count(place_of_departure_id) as total_refugees_in_place')
                     ->with('place_of_departure')
                     ->whereDoesntHave('drivers', function (Builder $query) use ($driverId) {
                         $query->where('driver_id', $driverId);
                     })->groupBy('place_of_departure_id')
                     ->having("total_refugees_in_place", ">", 0)
                     ->orderByDesc('total_refugees_in_place')
                     ->get() as $refugee) {
            $location[$refugee->place_of_departure_id]['count'] = $refugee->total_refugees_in_place;
            $location[$refugee->place_of_departure_id]['name'] = $refugee->place_of_departure->$locale;
        }

        return view('driver.locations', ['locations' => $location ?? []]);
    }

}
