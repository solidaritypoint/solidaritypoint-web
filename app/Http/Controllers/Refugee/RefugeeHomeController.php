<?php
declare(strict_types=1);

namespace App\Http\Controllers\Refugee;

use App\Http\Controllers\Controller;
use App\Models\DriverHasRefugee;
use App\Models\Refugee;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class RefugeeHomeController extends Controller
{
    public function create(): Factory|View|Application
    {
        $refugeeId = Refugee::where('user_id',auth()->user()->id)->first()->id ?? null;

        $acceptedOffers = DriverHasRefugee::with("driver")->with("driver.user")->with("refugee")
            ->where('refugee_id', $refugeeId)->where("status","accepted")->get();

        $unacceptedOffers = DriverHasRefugee::with("driver")->with("driver.user")->with("refugee")
            ->where('refugee_id', $refugeeId)
            ->where("status","!=","accepted")
            ->orderByRaw("FIELD('confirmed', 'offered', 'rejected','canceled') ASC")->get();

        return view('refugee.home',[
            "accepted_offers"=>collect($acceptedOffers)->toArray(),
            "unaccepted_offers"=>collect($unacceptedOffers)->toArray()
        ]);
    }

    public function changeOfferStatus(Request $request)
    {
        $refugeeId = Refugee::where('user_id',auth()->user()->id)->first()->id ?? null;

        if(($offer = DriverHasRefugee::where("id",$request->offer_id)->where('refugee_id', $refugeeId)->first()) == null) {
            return redirect(route('refugee.home', ['locale' => app()->getLocale()]))->with('error', 'Error');
        }

        // např. accepted smí být tehdy, kdy je nabídka offered
        $statusComb = [
            "confirmed" => ["offered"],
            "rejected"=> ["offered"],
            "canceled"=> ["confirmed","accepted"],
        ];
        if(isset($statusComb[$request->status]) && in_array($offer->status,$statusComb[$request->status])) {
            $offer->status = $request->status;
        }
        $offer->save();
        return redirect(route('refugee.home', ['locale' => app()->getLocale()]))->with('success', 'Success');

    }
}
