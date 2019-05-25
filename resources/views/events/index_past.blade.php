@extends('layouts.app') 
@section('content')
<div class="row">
    <div class="col">
        <h1>Akce</h1>
    </div>
    <div class="col text-right">
        <div class="btn-group" role="group" aria-label="Přepnout zobrazení">
            <a href="/events" class="btn btn-secondary">Přehled</a>
            <a href="/events/upcoming" class="btn btn-secondary">Nadcházející</a>
            <a href="/events/past" class="btn btn-primary">Uplynulé</a>
        </div>
    </div>
</div>
@if(count($pastEvents)>0)
<h2>Uplynulé akce</h2>
<div class="row">
    @foreach($pastEvents as $event)
        @include('events.card_item')
    @endforeach
</div>
{{$pastEvents->links()}} 
@else
<p>Žádné nadcházející akce</p>
@endif @auth @if( Auth::user()->hasAnyRole(['administrator','manager']))
<a href="/events/create" role="button" class="btn btn-primary">Přidat novou akci</a> @endif @endauth
@endsection