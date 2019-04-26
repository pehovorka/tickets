@extends('layouts.app')

@section('content')
    <h1>{{$event->name}}</h1>
    {!!$event->description!!}
    <p>
            <small>
                    @if($event->date_from == $event->date_to)
                        {{\Carbon\Carbon::parse($event->date_from)->format('d. m. Y')}}
                    @else
                        {{\Carbon\Carbon::parse($event->date_from)->format('d. m. Y')}} – {{\Carbon\Carbon::parse($event->date_to)->format('d. m. Y')}}
                    @endif
                </small>
    </p>


    <div class="jumbotron bg-dark text-white p-0">
        <div class="p-3">
            <div class="d-flex justify-content-between align-items-center">
            <h3 class="m-0">{{$event->venue->name}}</h3>
            <div>
                {{$event->venue->street}}, 
                {{chunk_split($event->venue->zip, 3, ' ')}}
                {{$event->venue->city}}, 
                {{$event->venue->country}}
            </div>
        </div>
            <p class="mt-3 mb-0">{{$event->venue->description}}</p>
        </div>
        <div style="height: 400px" id="map"></div>
        <script>
        var map;
        function initMap() {
            var venue = {lat: {{$event->venue->lat}}, lng: {{$event->venue->long}} };
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
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBV-1BgvCSbsQMdkMx7zOHszH6OTtYn1Tc&callback=initMap"
        async defer></script>

    </div>

    <a href="/events/" role="button" class="btn btn-outline-secondary">Zpět na seznam akcí</a>
    
    @auth
    @if( Auth::user()->hasAnyRole(['administrator','manager']))
    <a href="/events/{{$event->id}}/edit" role="button" class="btn btn-default">Upravit akci</a>
    {!!Form::open(['EventsController@destroy', $event->id, 'method' => 'POST', 'class' => 'float-right delete'])!!}
        {{Form::hidden('_method','DELETE')}}
        {{Form::submit('Smazat akci', ['class'=>'btn btn-danger'])}}
    {!!Form::close() !!}


    <script>
        $(".delete").on("submit", function(){
            return confirm("Opravdu chcete tuto akci odstranit??");
        });
    </script>
    @endif
    @endauth
@endsection
