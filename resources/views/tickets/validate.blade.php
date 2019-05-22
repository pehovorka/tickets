@extends('layouts.app') 
@section('content')
<h1>{{$ticket_user->original_event_name}} – {{$ticket_user->original_name}}</h1>
<div class="row">
    <div class="col">
        @if(is_null($ticket_user->used))
            <div class="card text-white bg-success">
                <div class="card-header pt-4">
                    <h2>PLATNÁ</h2>
                </div>
                <div class="card-body">
                    <p class="card-text">ID vstupenky: {{$ticket_user->uuid}}</p>
                    <div id="validate">
                        {{ Form::open(['action' => ['TicketsController@useTicket', $ticket_user->uuid], 'method' => 'POST']) }}
                        {{Form::submit('POUŽÍT', ['class'=>'btn btn-danger w-100 pt-4 pb-4'])}} {{ Form::close() }}
                    </div>
                </div>
            </div> 
        @else
            <div class="card text-white bg-danger">
                <div class="card-header pt-4">
                    <h2>NEPLATNÁ</h2>
                </div>
                <div class="card-body">
                    <p class="card-text">Použita {{$ticket_user->used}}</p>
                    <p class="card-text">ID vstupenky: {{$ticket_user->uuid}}</p>
                </div>
            </div>
        @endif
    </div>
    <div class="col">
        <h4 class="mt-4">{{$ticket_user->original_price}} Kč</h4>
        <hr>
        <h4>Doplňující informace</h4>
        <ul>
            <li>Zakoupeno: {{$ticket_user->transaction->date}}</li>
            <li>Zakoupil: {{$ticket_user->original_user_first_name.' '.$ticket_user->original_user_last_name}}</li>
            <li>Email: {{$ticket_user->original_user_email}}</li>
        </ul>
    </div>
</div>
@endsection