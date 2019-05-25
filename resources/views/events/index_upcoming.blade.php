@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col">
            <h1>Akce</h1>
        </div>
        <div class="col text-right">
                <div class="btn-group" role="group" aria-label="Přepnout zobrazení">
                    <a href="/events" class="btn btn-secondary">Přehled</a>
                    <a href="/events/upcoming" class="btn btn-primary">Nadcházející</a>
                    <a href="/events/past" class="btn btn-secondary">Uplynulé</a>
                </div>
        </div>
    </div>
    @if(count($upcomingEvents)>0)
        <h2>Nadcházející akce</h2>
        @foreach ($upcomingEvents->chunk(3) as $events)
            <div class="row mb-3">
                @foreach($events as $event)
                    @include('events.card_item')
                @endforeach
            </div>
        @endforeach
        {{$upcomingEvents->links()}}
    @else
        <p>Žádné nadcházející akce</p>
    @endif

    
    @auth
    @if( Auth::user()->hasAnyRole(['administrator','manager']))
        <a href="/events/create" role="button" class="btn btn-primary">Přidat novou akci</a>
    @endif
    @endauth
@endsection
