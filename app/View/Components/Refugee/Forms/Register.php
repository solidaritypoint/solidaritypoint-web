<?php

namespace App\View\Components\Refugee\Forms;

use App\Models\PlaceOfDeparture;
use Illuminate\View\Component;

class Register extends Component
{
    public $placesOfDeparture = [];
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        foreach(PlaceOfDeparture::get() as $place) {
            if($place[app()->getLocale()] != "") {
                $this->placesOfDeparture[$place[app()->getLocale()]] = $place[app()->getLocale()];
            }
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.refugee.forms.register');
    }
}
