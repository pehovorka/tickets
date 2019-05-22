@extends('layouts.app') 
@section('content')
@if(!is_null($ticket_user->used))
    <div class="alert alert-danger">
        Tato vstupenka již byla použita! ({{$ticket_user->used}})
    </div>
@endif
<h1>{{$ticket_user->original_event_name}} – {{$ticket_user->original_name}}</h1>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                Podrobnosti
            </div>
            <div class="card-body">
        <h4>Cena: {{$ticket_user->original_price}} Kč</h4>
        <hr>
        <ul>
            <li>Zakoupeno: {{$ticket_user->transaction->date}}</li>
            <li>Zakoupil: {{$ticket_user->original_user_first_name.' '.$ticket_user->original_user_last_name}}</li>
            <li>Email: {{$ticket_user->original_user_email}}</li>
        </ul>
    </div>
</div>
</div>
    <div class="col text-center">
            {!! QrCode::size(300)->backgroundColor(248,250,252)->generate(route('validateTicket',$ticket_user->uuid)); !!}
    </div>
</div>
<hr>
@if(isset($ticket_user->original_venue_name))
<h4>Místo konání – {{$ticket_user->original_venue_name}}</h4>
@endif
@if(isset($ticket_user->ticket->event->venue))
<p>
    {{$ticket_user->ticket->event->venue->street}}, {{chunk_split($ticket_user->ticket->event->venue->zip, 3, ' ')}} {{$ticket_user->ticket->event->venue->city}},
    {{$ticket_user->ticket->event->venue->country}}
</p>
<div style="height: 400px" id="map"></div>
<script>
    var map;
function initMap() {
    var venue = {lat: {{$ticket_user->ticket->event->venue->lat}}, lng: {{$ticket_user->ticket->event->venue->long}} };
    // The map, centered at venue
    var map = new google.maps.Map(
        document.getElementById('map'), {
            zoom: 16, 
            center: venue,
            disableDefaultUI: true,
            zoomControl: true,
        });
    // The marker, positioned at venue
    var marker = new google.maps.Marker({position: venue, map: map});
}

</script>
<script src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_API_KEY')}}&callback=initMap" async defer></script>
@endif
<p class="mt-3">ID vstupenky: {{$ticket_user->uuid}}</p>
@endsection