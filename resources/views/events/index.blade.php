@extends('layouts.app')


@section('content')
    <h1>Akce</h1>
    @if(count($events)>0)
        @foreach ($events as $event)
            <div class="card mb-3">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img src="/storage/cover_images/{{$event->img}}" class="card-img" alt="{{$event->name}}">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                            <h2 class="card-title"><a href="./events/{{$event->id}}">{{$event->name}}</a></h2>
                            <p class="card-text">{{$event->venue->name}}</p>
                            <p class="card-text"><small class="text-muted">
                                @if($event->date_from == $event->date_to)
                                    {{\Carbon\Carbon::parse($event->date_from)->format('d. m. Y')}}
                                @else
                                    {{\Carbon\Carbon::parse($event->date_from)->format('d. m. Y')}} – {{\Carbon\Carbon::parse($event->date_to)->format('d. m. Y')}}
                                @endif    
                            </small></p>
                            </div>
                        </div>
                    </div>
            </div>
        @endforeach
    @else 
        <p>Žádné akce tady nemáme :(</p>
    @endif
    
    @auth
    @if( Auth::user()->hasAnyRole(['administrator','manager']))
        <a href="/events/create" role="button" class="btn btn-primary">Přidat novou akci</a>
    @endif
    @endauth
@endsection
