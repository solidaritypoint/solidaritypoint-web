<?php
declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;

class RegisteredQuartermasterController extends Controller
{

    public function create(){

        return view('auth.register-quartermaster');
    }

    public function store() {
        // Todo validation
        return redirect(route(auth()->user()->role.'.'.RouteServiceProvider::HOME, ['locale' => app()->getLocale()]));
    }

}
