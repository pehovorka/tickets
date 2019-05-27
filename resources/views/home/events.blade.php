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
                @if (Auth::user()->hasRole('administrator'))
                    <th scope="col">Autor</th>
                @endif
                <th scope="col">Akce</th>
              </tr>
            </thead>
            <tbody>
        @foreach ($events as $event)
            <tr>
                <th scope="row" class="align-middle"><a href="/events/{{$event->id}}">{{$event->name}}</a></th>
                <td class="align-middle">@if ($event->venue){{$event->venue->name}} @endif</td>
                <td class="align-middle">@if($event->date_from == $event->date_to)
                        {{\Carbon\Carbon::parse($event->date_from)->format('d. m. Y')}}
                    @else
                        {{\Carbon\Carbon::parse($event->date_from)->format('d. m. Y')}} – {{\Carbon\Carbon::parse($event->date_to)->format('d. m. Y')}}
                    @endif    
                </td>
                @if (Auth::user()->hasRole('administrator'))
                <td scope="col">{{$event->user->first_name.' '.$event->user->last_name}}</td>
                @endif
                <td>
                    <div class="btn-group w-100" role="group">
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
    <a href="/home" role="button" class="btn btn-secondary">Zpět na hlavní panel</a>
    <a href="/events/create" role="button" class="btn btn-primary float-right">Přidat novou akci</a>
    <script>
        $(".delete").on("submit", function(){
            return confirm("Opravdu chcete tuto akci odstranit?");
        });
    </script>
@endsection
