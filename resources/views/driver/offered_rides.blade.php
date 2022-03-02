<x-app-layout>
    <div class="container">
        <h5 class="mt-2 text-center">{{__('driver.offer_overview')}}</h5>

        <ul class="list-group">
            @foreach($refugees as $refugee)
                @php
                    $randInfoId = 'info-'.rand(999999,999999999999);
                @endphp
                <li class="list-group-item">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5>
                            @if($refugee['user']['first_name'] != "" && $refugee['user']['last_name'] != "")
                                {{$refugee['user']['first_name']}} {{$refugee['user']['last_name']}}
                            @else
                                {{$refugee['user']['email']}}
                            @endif
                        </h5>
                        <span class="text-dark">{{date('d.m.Y H:i:s', strtotime($refugee['created_at']))}}</span>
                    </div>
                    <div>Místo odvozu: {{$refugee['place_of_departure'][app()->getLocale()]}}</div>
                    <div>Počet osob: {{$refugee['people_in_group']}}</div>
                    <div class="d-flex">
                        Věk: {{ $refugee['age'] }} @if($refugee['gender'] == 'F')
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
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Status: <x-offer.status :status="$refugee['drivers'][0]['pivot']['status']"/></span>

                        <form  method="post" action="{{url(app()->getLocale().'/driver/change_offer_status')}}"
                               @if($free_seats < $refugee['people_in_group'])
                               onsubmit="return confirm('V autě není dostatek volných míst ({!! $free_seats !!} zbývá), přejete si přesto nabídku akceptovat?');"
                            @endif
                        >
                        @csrf <!-- {{ csrf_field() }} -->
                            <input type="hidden" value="{{$refugee['drivers'][0]['pivot']["id"]}}" name="offer_id">
                            <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#{{$randInfoId}}" aria-expanded="false" aria-controls="{{$randInfoId}}">
                                {{__('driver.more_info')}}
                            </button>
                            @if($refugee['drivers'][0]['pivot']['status'] == "confirmed")
                                <button class="btn btn-sm btn-danger" type="submit" name="status" value="rejected">
                                    {{__('offer_status.reject_offer')}}
                                </button>
                                <button class="btn btn-sm btn-success" type="submit" name="status"  value="accepted">
                                    {{__('offer_status.accept_offer')}}
                                </button>
                            @endif
                            @if(in_array($refugee['drivers'][0]['pivot']['status'],["offered","accepted"]) )
                                <button class="btn btn-sm btn-danger" type="submit" name="status" value="canceled">
                                    {{__('offer_status.cancel_offer')}}
                                </button>
                            @endif
                        </form>

                    </div>
                    <div class="collapse" id="{{$randInfoId}}">
                        <div>Name: {{$refugee['user']['first_name']}} {{$refugee['user']['last_name']}}</div>
                        <div>Email: {{$refugee['user']['email']}}</div>
                        <div>Facebook: {{$refugee['facebook']}}</div>
                        <div>Twitter: {{$refugee['twitter']}}</div>
                        <div>Phone: {{$refugee['phone']}}</div>
                        <div>WhatsApp:
                            @if($refugee['has_whatsapp'])
                                <span class="badge bg-success">{{__('driver.yes')}}</span>
                            @else
                                <span class="badge bg-danger">{{__('driver.no')}}</span>
                            @endif
                        </div>
                        <div>Signal:
                            @if($refugee['has_signal'])
                                <span class="badge bg-success">{{__('driver.yes')}}</span>
                            @else
                                <span class="badge bg-danger">{{__('driver.no')}}</span>
                            @endif
                        </div>
                        <div>Telegram:
                            @if($refugee['has_telegram'])
                                <span class="badge bg-success">{{__('driver.yes')}}</span>
                            @else
                                <span class="badge bg-danger">{{__('driver.no')}}</span>
                            @endif
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</x-app-layout>
