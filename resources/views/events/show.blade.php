@extends('layouts.app')

@section('content')
    @if($event->date_to < now()->format('Y-m-d'))
        <div class="alert alert-warning" role="alert">
            Prohlížíte uplynulou akci.
        </div>
    @endif
    <div class="d-flex align-items-center">
        <h1 class="mr-4">{{$event->name}}</h1>
        @foreach ($event->event_category as $category)
            <span class="badge badge-info ml-2 text-light">{{$category->name}}</span>
        @endforeach
    </div>
    <img src="/storage/cover_images/{{$event->img}}" class="card-img mb-4" alt="{{$event->name}}">
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

    @if (count($event->ticket) > 0)
        <h3>Vstupenky</h3>
        @if($event->date_to < now()->format('Y-m-d'))
            <div class="alert alert-danger" role="alert">
                Tato akce již proběhla, nelze zakoupit vstupenky!
            </div>
        @else
        @foreach ($event->ticket as $ticket)
        {{ Form::open(['action' => ['TicketsController@showOrder', $ticket->id], 'method' => 'POST']) }}
        <div class="card bg-secondary text-white mb-3">
                <div class="row no-gutters">
                  <div class="col-md-2">
                    <i class="fas fa-ticket-alt fa-7x ml-3 text-white"></i>
                  </div>
                  <div class="col-md-5 align-items-center d-flex justify-content-center">
                    <div class="card-body">
                      <span class="mb-0 ticketText">{{$ticket->name}}</span>
                    </div>
                  </div>
                  <div class="col-md-2 align-items-center d-flex justify-content-center">
                    <div class="card-body text-right">
                        <span class="mb-0 ticketText"><strong>{{number_format($ticket->price, 0, ',', ' ')}} Kč</strong></span>
                    </div>
                  </div>

                  <div class="col-md-1 align-items-center d-flex justify-content-center">
                    <div class="card-body form-group form-group-lg p-3 mb-0">
                        {{Form::number('quantity', '1', ['class' => 'form-control input-number text-center', 'required', 'min' => '1', 'max' => '10'])}}
                    </div>
                  </div>
                  <div class="col-md-2 align-items-center d-flex justify-content-center">
                    <div class="card-body text-right">
                        {{Form::submit('Koupit', ['class'=>'btn btn-primary ticketText w-100'])}}
                    </div>
                  </div>
                 
                </div>
              </div>
              {{ Form::close() }}
        @endforeach
        @endif
    @endif
    @if ($event->venue)
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
            <script src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_API_KEY')}}&callback=initMap"
            async defer></script>

        </div>
    @endif

    <a href="/events/" role="button" class="btn btn-outline-secondary">Zpět na seznam akcí</a>
    
    @auth
    @if(( Auth::user()->hasRole('manager') && Auth::user()->id == $event->user_id ) || Auth::user()->hasRole('administrator') )
    <div class="float-right">
        <a href="/events/{{$event->id}}/edit" role="button" class="btn btn-primary">Upravit akci</a>
        {!!Form::open(['EventsController@destroy', $event->id, 'method' => 'POST', 'class' => 'float-right delete'])!!}
            {{Form::hidden('_method','DELETE')}}
            {{Form::submit('Smazat akci', ['class'=>'btn btn-danger'])}}
        {!!Form::close() !!}
    </div>


    <script>
        $(".delete").on("submit", function(){
            return confirm("Opravdu chcete tuto akci odstranit?");
        });
    </script>
    @endif
    @endauth
@endsection
