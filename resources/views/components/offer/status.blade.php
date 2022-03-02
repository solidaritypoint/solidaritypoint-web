@if($status == "offered")
    <span class="badge bg-primary">{{__('offer_status.'.$status)}}</span>
@elseif($status == "confirmed")
    <span class="badge bg-warning">{{__('offer_status.'.$status)}}</span>
@elseif($status == "accepted")
    <span class="badge bg-success">{{__('offer_status.'.$status)}}</span>
@else
    <span class="badge bg-danger">{{__('offer_status.'.$status)}}</span>
@endif
