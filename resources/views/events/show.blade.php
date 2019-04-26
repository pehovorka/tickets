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
    
    @auth
    @if( Auth::user()->hasAnyRole(['administrator','manager']))
    <a href="/events/{{$event->id}}/edit" role="button" class="btn btn-default">Upravit akci</a>
    {!!Form::open(['EventsController@destroy', $event->id, 'method' => 'POST', 'class' => 'float-right delete'])!!}
        {{Form::hidden('_method','DELETE')}}
        {{Form::submit('Smazat akci', ['class'=>'btn btn-danger'])}}
    {!!Form::close() !!}


    <script>
        $(".delete").on("submit", function(){
            return confirm("Opravdu chcete tuto akci odstranit??");
        });
    </script>
    @endif
    @endauth
@endsection
