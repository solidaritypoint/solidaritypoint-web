
<ul class="list-group">
    @foreach($offers as $offer)
        @php
                $randInfoId = 'info-'.rand(999999,999999999999);
        @endphp
        <li class="list-group-item">
            <div class="d-flex justify-content-between align-items-center">
                <h5>
                    @if($offer['driver']["user"]['first_name'] != "" && $offer['driver']["user"]['last_name'] != "")
                        {{$offer['driver']["user"]['first_name']}} {{$offer['driver']["user"]['last_name']}}
                    @else
                        {{$offer['driver']["user"]['email']}}
                    @endif
                </h5>
                <span class="text-dark">{{date('d.m.Y H:i:s', strtotime($offer['created_at']))}}</span>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <span>Status:
                    <x-offer.status :status="$offer['status']"/>
                </span>

                <form  method="post" action="{{url(app()->getLocale().'/refugee/change_offer_status')}}">
                    @csrf <!-- {{ csrf_field() }} -->
                    <input type="hidden" value="{{$offer["id"]}}" name="offer_id">
                    <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#{{$randInfoId}}" aria-expanded="false" aria-controls="{{$randInfoId}}">
                        {{__('driver.more_info')}}
                    </button>
                    @if($offer["status"] == "offered")
                        <button class="btn btn-sm btn-danger" type="submit" name="status" value="rejected">
                            {{__('offer_status.reject_offer')}}
                        </button>
                        <button class="btn btn-sm btn-success" type="submit" name="status" value="confirmed">
                            {{__('offer_status.confirm_offer')}}
                        </button>
                    @elseif($offer["status"] == "confirmed" || $offer["status"] == "accepted")
                        <button class="btn btn-sm btn-danger" type="submit" name="status" value="canceled">
                            {{__('offer_status.cancel_offer')}}
                        </button>
                    @endif
                </form>
            </div>
            <div class="collapse" id="{{$randInfoId}}">
                <div>Name: {{$offer['driver']['user']['first_name']}} {{$offer['driver']['user']['last_name']}}</div>
                <div>Email: {{$offer['driver']['user']['email']}}</div>
                <div>Car type: {{$offer['driver']['car_type']}}</div>
                <div>Car color: {{$offer['driver']['car_color']}}</div>
                <div>Car SPZ: {{$offer['driver']['car_spz']}}</div>
                <div>Note: {{$offer['driver']['note']}}</div>
                <div>City: {{$offer['driver']['city']}}</div>
                <div>Country: {{$offer['driver']['country']}}</div>
                <div>Phone: {{$offer['driver']['phone']}}</div>
                <div>Facebook: {{$offer['driver']['facebook']}}</div>
                <div>Twitter: {{$offer['driver']['twitter']}}</div>
                <div>WhatsApp:
                    @if($offer['driver']['has_whatsapp'])
                        <span class="badge bg-success">{{__('driver.yes')}}</span>
                    @else
                        <span class="badge bg-danger">{{__('driver.no')}}</span>
                    @endif
                </div>
                <div>Signal:
                    @if($offer['driver']['has_signal'])
                        <span class="badge bg-success">{{__('driver.yes')}}</span>
                    @else
                        <span class="badge bg-danger">{{__('driver.no')}}</span>
                    @endif
                </div>
                <div>Telegram:
                    @if($offer['driver']['has_telegram'])
                        <span class="badge bg-success">{{__('driver.yes')}}</span>
                    @else
                        <span class="badge bg-danger">{{__('driver.no')}}</span>
                    @endif
                </div>
            </div>
        </li>
    @endforeach
</ul>
