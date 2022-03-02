<?php
declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PlaceOfDeparture;
use App\Models\Refugee;
use App\Models\RefugeeCompanion;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredRefugeeController extends Controller
{
    public function create(): Factory|View|Application
    {
        foreach(PlaceOfDeparture::get() as $place) {
            if($place[app()->getLocale()] != "") {
                $placesOfDeparture[$place[app()->getLocale()]] = $place[app()->getLocale()];
            }
        }

        return view('auth.register-refugee', [
            'placesOfDeparture' => $placesOfDeparture ?? []
        ]);
    }

    public function store(Request $request) {
        // Todo validation
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        DB::transaction(function () use ($request) {
            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'first_name' => $request->first_name ?? null,
                'last_name' => $request->last_name ?? null,
                'role' => 'refugee',
            ]);

            if(($departure = PlaceOfDeparture::where(app()->getLocale(),$request->place_of_departure)->first()) == null) {
                $departure = new PlaceOfDeparture();
                $departure->fill([app()->getLocale() => $request->place_of_departure]);
                $departure->save();
            }

            $refugee = Refugee::create([
                'user_id' => $user->id,
                'note' => $request->note,
                'gender' => $request->refugee_gender,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'phone' => $request->phone,
                'has_telegram' => (bool)$request->has_telegram ?? 0,
                'has_signal' => (bool)$request->has_signal ?? 0,
                'has_whatsapp' => (bool)$request->has_whatsapp ?? 0,
                'place_of_departure_id' => $departure->id,
                'people_in_group' => 0,
                'adults_in_group' => 0,
                'kids_in_group' => 0,
                'age' => $request->refugee_age,
            ]);

            $adults = 1;
            $kids = 0;
            $members = 1;

            foreach($request->age as $index => $item) {
                if ($request->age[$index] == "") {
                    continue;
                }

                RefugeeCompanion::create([
                    'refugee_id' => $refugee->id,
                    'age' => $request->age[$index],
                    'gender' => $request->gender[$index]
                ]);

                if ($request->age[$index] < 18) {
                    $kids++;
                } else {
                    $adults++;
                }
                $members++;
            }

            $refugee->adults_in_group = $adults;
            $refugee->people_in_group = $members;
            $refugee->kids_in_group = $kids;
            $refugee->save();

            event(new Registered($user));

            Auth::login($user);
        });

        return redirect(route(auth()->user()->role.'.'.RouteServiceProvider::HOME, ['locale' => app()->getLocale()]));
    }
}
