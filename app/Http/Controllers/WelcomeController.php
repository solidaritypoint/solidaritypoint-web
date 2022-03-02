<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class WelcomeController extends Controller
{
    public function create(): Factory|View|Application
    {
        return view('welcome', ["lang" => [
            "ua", "cs", "en"
            //"en", "cs", "pl", "sk", "hu", "ro", "de", "ua"
        ]]);
    }
}
