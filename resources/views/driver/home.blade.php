<x-app-layout>

    <div class="container">
        <div class="py-5 text-center">
            <h5 class="">Přehled</h5>

            @if($confirmed_offers > 0)
                <div class="alert alert-danger">
                    Máte {{$confirmed_offers}} potvrzených nabídek úprchlíky
                    <a href="{{url('/'.app()->getLocale().'/driver/offered_rides')}}">Zobrazit</a>
                </div>
            @endif
            <li class="list-group-item">
                <div>Akceptovaných odvozů: {{$accepted_offers}}</div>
                <div>Nepotvrzených nabídnutých odvozů: {{$offered_offers}}</div>
                <div>Akceptovaných uprchlíků: {{$reserved_seats}}</div>
                <div>Zbývajících míst v autě: {{$seats-$reserved_seats}} z {{$seats}}</div>
            </li>
            <h5 class="mt-3">Možnosti</h5>

            <a href="{{url('/'.app()->getLocale().'/driver/locations')}}">
                <button type="button" class="mt-2 btn btn-primary w-50">{{__('navigation.locations')}}</button>
            </a>
            <a href="{{url('/'.app()->getLocale().'/driver/offered_rides')}}">
                <button type="button" class="mt-2 btn btn-primary w-50">{{__('navigation.offered_rides')}}</button>
            </a>

        </div>
    </div>
</x-app-layout>
