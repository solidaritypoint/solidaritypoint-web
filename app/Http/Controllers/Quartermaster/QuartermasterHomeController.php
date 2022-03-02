<?php
declare(strict_types=1);

namespace App\Http\Controllers\Quartermaster;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class QuartermasterHomeController extends Controller
{

    public function create(): Factory|View|Application
    {
        return view('quartermaster.home');
    }
}
