<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredDriverController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return View
     */
    public function create(): View
    {
        return view('auth.register-driver');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param Request $request
     * @return RedirectResponse
     *
     */
    public function store(Request $request): RedirectResponse
    {
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
                'role' => 'driver',
            ]);

            Driver::create([
                'user_id' => $user->id,
                'age' => $request->age,
                'gender' => $request->gender,
                'seats' => $request->seats,
                'child_seats' => $request->child_seats,
                'car_type' => $request->car_type,
                'car_color' => $request->car_color,
                'car_spz' => $request->car_spz,
                'city' => $request->city,
                'country' => $request->country,
                'phone' => $request->phone,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'has_whatsapp' => $request->has_whatsapp ?? false,
                'has_signal' => $request->has_signal ?? false,
                'has_telegram' => $request->has_telegram ?? false,
                'note' => $request->note
            ]);

            event(new Registered($user));

            Auth::login($user);
        });

        return redirect(route(auth()->user()->role.'.'.RouteServiceProvider::HOME, ['locale' => app()->getLocale()]));
    }
}
