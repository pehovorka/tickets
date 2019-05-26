@extends('layouts.app')

@section('content')
    @if(count($upcomingEvents)>0)
    <div class="main-carousel">
        <div id="carouselCaptions" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselCaptions" data-slide-to="0" class="active"></li>
            <li data-target="#carouselCaptions" data-slide-to="1"></li>
            <li data-target="#carouselCaptions" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner bg-white text-center border rounded-lg" style="height: 600px">
            @foreach($upcomingEvents as $event)
                <div class="carousel-item {{ $loop->first ? ' active' : '' }}" style="height: 600px">
                    <a href="/events/{{$event->id}}">
                    <img src="/storage/cover_images/{{$event->img}}" class="d-block w-100" alt="{{$event->name}}" style="max-height: 470px; width: auto; object-fit: cover;"></a>
                    <div class="w-100" style="position: absolute; bottom: 25px">
                      <h3 class="text-center mt-3"><a href="/events/{{$event->id}}" class="text-dark">{{$event->name}}</a></h3>
                      <p>
                      @if($event->date_from == $event->date_to)
                        {{\Carbon\Carbon::parse($event->date_from)->format('d. m. Y')}}
                    @else
                        {{\Carbon\Carbon::parse($event->date_from)->format('d. m. Y')}} – {{\Carbon\Carbon::parse($event->date_to)->format('d. m. Y')}}
                    @endif   
                    @if($event->venue)({{$event->venue->name}})@endif</p> 
                    </div>
                  </div>
            @endforeach
          </div>
          <a class="carousel-control-prev" href="#carouselCaptions" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Předchozí</span>
          </a>
          <a class="carousel-control-next" href="#carouselCaptions" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Následující</span>
          </a>
        </div>
      </div>
      @endif
      <div class="jumbotron text-center bg-transparent">
            <h1>Vítejte na portálu <strong>KupVstup</strong>!</h1>
            <p>Nejen festivaly a koncerty.</p>
            <a href="/events" class="btn btn-primary btn-lg">Zobrazit všechny akce</a>
      </div>
@endsection
