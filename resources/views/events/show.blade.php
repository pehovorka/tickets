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
    <a href="/events/" role="button" class="btn btn-outline-secondary">Zpět na seznam akcí</a>
    <a href="/events/{{$event->id}}/edit" role="button" class="btn btn-default">Upravit akci</a>
    <a href="/events/{{$event->id}}/delete" role="button" class="btn btn-default">Smazat akci</a>
@endsection
