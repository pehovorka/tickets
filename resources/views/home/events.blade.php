@extends('layouts.app')


@section('content')
    <h1>Správa akcí</h1>
    @if(count($events)>0)
    <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Název</th>
                <th scope="col">Místo</th>
                <th scope="col">Datum</th>
                <th scope="col">Akce</th>
              </tr>
            </thead>
            <tbody>
        @foreach ($events as $event)
            <tr>
                <th scope="row" class="align-middle">{{$event->name}}</th>
                <td class="align-middle">{{$event->venue->name}}</td>
                <td class="align-middle">@if($event->date_from == $event->date_to)
                        {{\Carbon\Carbon::parse($event->date_from)->format('d. m. Y')}}
                    @else
                        {{\Carbon\Carbon::parse($event->date_from)->format('d. m. Y')}} – {{\Carbon\Carbon::parse($event->date_to)->format('d. m. Y')}}
                    @endif    
                </td>
                <td>
                    <div class="btn-group" role="group">
                        <a href="/events/{{$event->id}}/edit" role="button" class="btn btn-primary rounded-0">Upravit</a>
                        {!!Form::open(['action' => ['EventsController@destroy', $event->id], 'method' => 'POST', 'class' => 'delete'])!!}
                            {{Form::hidden('_method','DELETE')}}
                            {{Form::submit('Smazat', ['class'=>'btn btn-danger rounded-0'])}}
                        {!!Form::close() !!}
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @else 
        <p>Nevytvořili jste žádnou akci</p>
    @endif
    
    @auth
    @if( Auth::user()->hasAnyRole(['administrator','manager']))
        <a href="/events/create" role="button" class="btn btn-primary">Přidat novou akci</a>
    @endif
    @endauth
    <a href="/home" role="button" class="btn btn-secondary">Zpět na hlavní panel</a>
    <script>
        $(".delete").on("submit", function(){
            return confirm("Opravdu chcete tuto akci odstranit??");
        });
    </script>
@endsection
