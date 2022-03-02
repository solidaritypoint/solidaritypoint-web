<?php
declare(strict_types=1);

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\DriverHasRefugee;
use App\Models\PlaceOfDeparture;
use App\Models\Refugee;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class DriverLocationController extends Controller
{
    public function create(string $locale, int $id): Factory|View|Application
    {
        $driverId = Driver::where('user_id', auth()->user()->id)->first()->id ?? null;
        $refugees = Refugee::where('place_of_departure_id', $id)->with('user')->with('refugee_companions')
            ->whereDoesntHave('drivers', function (Builder $query) use($driverId) {
                $query->where('driver_id', $driverId);
            })->get();

        return view('driver.location', [
            'place_of_departure_id' => $id,
            'refugees' => collect($refugees)->toArray(),
            'location_name' => PlaceOfDeparture::find($id)->$locale ?? ''
        ]);
    }

    public function sendOffer(Request $request)
    {
        $driverId = Driver::where('user_id', auth()->user()->id)->first()->id ?? null;
        if (($refugee = Refugee::where("id", $request->refugee_id)->where("place_of_departure_id",$request->place_of_departure_id)->first()) != null
            && !DriverHasRefugee::where("refugee_id", $refugee->id)->where("driver_id", $driverId)->exists()) {
            $table = new DriverHasRefugee();
            $table->refugee_id = $refugee->id;
            $table->status = "offered";
            $table->driver_id = $driverId;
            $table->save();

            return redirect(app()->getLocale() . '/driver/location/'.$request->place_of_departure_id)->with('success', 'Success');
        }
        return redirect(app()->getLocale() . '/driver/location'.$request->place_of_departure_id)->with('error', 'Error');
    }
}
