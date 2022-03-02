<x-app-layout>

    <div class="container">
        <div class="py-5 text-center">
            <h2><img src="{{asset('storage/sp-logo.png')}}" alt="" width="70"> SolidarityPoint</h2>

            @foreach($lang AS $l)
                <a href="{{route('welcome', ['locale' => $l])}}" class="mt-2 btn @if (app()->getLocale() == $l)btn-success @else btn-secondary @endif w-10" role="button">{{Str::upper($l)}}</a>
            @endforeach

            <h5 class="mt-5">{{__('homepage.register_as')}}</h5>
            <a class='btn btn-primary w-50 mt-2' href="{{route('register.refugee', ['locale' => app()->getLocale()])}}">
                {{__('homepage.register_as_refugee')}}
            </a>
            <a class='btn btn-primary w-50 mt-2' href="{{route('register.driver', ['locale' => app()->getLocale()])}}">
                {{__('homepage.register_as_driver')}}
            </a>

            <h5 class="mt-4">{{__('homepage.have_account')}}</h5>
            <a class="btn btn-secondary w-50" href="{{route('login', ['locale' => app()->getLocale()])}}" >
                {{__('homepage.log_in')}}
            </a>
	    <br />
	    <br />
            <p class="lead">{{__('homepage.description')}}</p>
        </div>
    </div>
</x-app-layout>
