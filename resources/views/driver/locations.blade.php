<x-app-layout>
    <h5 class="mt-2 text-center">{{__('driver.heading')}}</h5>
    <div class="d-flex flex-column container" style="row-gap: .5rem">
        @if(empty($locations))
            <p class="text-center">Vsichni uprchlici byli odvezeni.</p>
        @endif
        @foreach($locations as $index => $location)
                <a class='btn btn-outline-primary d-flex justify-content-between' href="{{route('driver.location', ['locale' => app()->getLocale(), 'id' => $index])}}">
                    <span>{{$location['name']}}</span>
                    <span class="badge bg-danger">{{$location['count']}}</span>
                </a>
        @endforeach

    </div>
</x-app-layout>
