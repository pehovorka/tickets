@extends('layouts.app')


@section('content')
    <h1>Akce</h1>
    @if(count($events)>0)
        @foreach ($events as $event)
            <div class="card mb-3">
                <div class="card-body">
                    <h2 class="card-title"><a href="./events/{{$event->id}}">{{$event->name}}</a></h2>
                    <small>
                        @if($event->date_from == $event->date_to)
                            {{\Carbon\Carbon::parse($event->date_from)->format('d. m. Y')}}
                        @else
                            {{\Carbon\Carbon::parse($event->date_from)->format('d. m. Y')}} – {{\Carbon\Carbon::parse($event->date_to)->format('d. m. Y')}}
                        @endif
                    </small>
                </div>
            </div>
        @endforeach
    @else 
        <p>Žádné akce tady nemáme :(</p>
    @endif
    <a href="/events/create" role="button" class="btn btn-primary">Přidat novou akci</a>
@endsection
