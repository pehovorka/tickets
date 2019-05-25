@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col">
            <h1>Akce</h1>
        </div>
        <div class="col text-right">
                <div class="btn-group" role="group" aria-label="Přepnout zobrazení">
                        <a href="/events" class="btn btn-primary">Přehled</a>
                        <a href="/events/upcoming" class="btn btn-secondary">Nadcházející</a>
                        <a href="/events/past" class="btn btn-secondary">Uplynulé</a>
                </div>
        </div>
    </div>
    @if(count($currentEvents)>0)
        <h2>Aktuální</h2>
        <div class="row">
            @foreach($currentEvents as $event)
                @include('events.card_item')
            @endforeach
        </div>
    @endif

    @if(count($upcomingEvents)>0)
        <h2>Nadcházející</h2>
        <div class="row">
                @foreach($upcomingEvents as $event)
                    @include('events.card_item')
                @endforeach
            </div>
    @endif
    <a href="/events/upcoming" class="btn btn-secondary w-100">Zobrazit více nadcházejících akcí</a>
    
    @auth
    @if( Auth::user()->hasAnyRole(['administrator','manager']))
        <a href="/events/create" role="button" class="btn btn-primary">Přidat novou akci</a>
    @endif
    @endauth
@endsection
