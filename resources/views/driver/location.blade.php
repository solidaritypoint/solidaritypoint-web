<x-app-layout>
    <div class="container">
        <h5 class="mt-2 text-center">{{$location_name}}</h5>

        <ul class="list-group">
            @foreach($refugees as $refugee)
                <li class="list-group-item">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5>{{$refugee['user']['first_name']}} {{$refugee['user']['last_name']}}</h5><span class="text-dark">{{date('Y-m-d H:i:s', strtotime($refugee['created_at']))}}</span>
                    </div>
                    <div>Pocet: {{$refugee['people_in_group']}}</div>
                    <div class="d-flex">
                        Vek: {{ $refugee['age'] }} @if($refugee['gender'] == 'F')
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-gender-female" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                      d="M8 1a4 4 0 1 0 0 8 4 4 0 0 0 0-8zM3 5a5 5 0 1 1 5.5 4.975V12h2a.5.5 0 0 1 0 1h-2v2.5a.5.5 0 0 1-1 0V13h-2a.5.5 0 0 1 0-1h2V9.975A5 5 0 0 1 3 5z"/>
                            </svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-gender-male" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                      d="M9.5 2a.5.5 0 0 1 0-1h5a.5.5 0 0 1 .5.5v5a.5.5 0 0 1-1 0V2.707L9.871 6.836a5 5 0 1 1-.707-.707L13.293 2H9.5zM6 6a4 4 0 1 0 0 8 4 4 0 0 0 0-8z"/>
                            </svg>
                        @endif
                        @foreach($refugee['refugee_companions'] as $companion)
                            {{$companion['age']}}
                            @if($companion['gender'] == 'F')
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-gender-female" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                          d="M8 1a4 4 0 1 0 0 8 4 4 0 0 0 0-8zM3 5a5 5 0 1 1 5.5 4.975V12h2a.5.5 0 0 1 0 1h-2v2.5a.5.5 0 0 1-1 0V13h-2a.5.5 0 0 1 0-1h2V9.975A5 5 0 0 1 3 5z"/>
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-gender-male" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                          d="M9.5 2a.5.5 0 0 1 0-1h5a.5.5 0 0 1 .5.5v5a.5.5 0 0 1-1 0V2.707L9.871 6.836a5 5 0 1 1-.707-.707L13.293 2H9.5zM6 6a4 4 0 1 0 0 8 4 4 0 0 0 0-8z"/>
                                </svg>
                            @endif
                        @endforeach
                    </div>
                    <form  method="post" action="{{url(app()->getLocale().'/driver/location_send_offer')}}">
                        @csrf <!-- {{ csrf_field() }} -->
                        <input type="hidden" value="{{$refugee["id"]}}" name="refugee_id">
                        <input type="hidden" value="{{$place_of_departure_id}}" name="place_of_departure_id">
                        <button type="submit" class="btn btn-sm btn-success w-100">{{__('driver.offer_ride')}}</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
</x-app-layout>
