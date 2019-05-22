@extends('layouts.app')


@section('content')
    <h1>Vaše vstupenky</h1>
    @if(count($tickets)>0)
    <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Název akce</th>
                <th scope="col">Vstupenka</th>
                <th scope="col">Cena</th>
                <th scope="col">Použita</th>
                <th scope="col">Akce</th>
              </tr>
            </thead>
            <tbody>
        @foreach ($tickets as $ticket)
            <tr>
                <th scope="row" class="align-middle">@if(isset($ticket->ticket->event))<a href="/events/{{$ticket->ticket->event->id}}">{{$ticket->ticket->event->name}}</a>@else{{$ticket->original_event_name}}@endif</th>
                <td class="align-middle">{{$ticket->original_name}}</td>
                <td class="align-middle">{{$ticket->original_price}} Kč</td>
                <td class="align-middle">@if(isset($ticket->used)){{$ticket->used}}@else NE @endif</td>
                <td><a href="/tickets/show/{{$ticket->uuid}}" role="button" class="btn btn-primary rounded-0">Zobrazit</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @else 
        <p>Zatím nemáte žádnou zakoupenou vstupenku.</p>
    @endif
    <a href="/home" role="button" class="btn btn-secondary">Zpět na hlavní panel</a>
@endsection
