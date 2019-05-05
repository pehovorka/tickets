@extends('layouts.app')


@section('content')
    <h1>Správa míst</h1>
    @if(count($venues)>0)
    <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Název</th>
                <th scope="col">Adresa</th>
                <th scope="col">Mapa</th>
                <th scope="col">Akce</th>
              </tr>
            </thead>
            <tbody>
        @foreach ($venues as $venue)
            <tr>
                <th scope="row" class="align-middle">{{$venue->name}}</th>
                <td class="align-middle">
                        {{$venue->street}}, 
                        {{chunk_split($venue->zip, 3, ' ')}}
                        {{$venue->city}}, 
                        {{$venue->country}}</td>
                <td class="align-middle">
                    <a href="https://www.google.com/maps/search/?api=1&query={{$venue->lat}},{{$venue->long}}">Google Maps</a>, <a href="https://mapy.cz/zakladni?x={{$venue->long}}&y={{$venue->lat}}&z=16&source=coor&id={{$venue->long}}%2C{{$venue->lat}}">Mapy.cz</a>
                </td>
                <td>
                    <div class="btn-group" role="group">
                        <div class="btn-group" role="group">
                            <a href="/venues/{{$venue->id}}/edit" role="button" class="btn btn-primary rounded-0">Upravit</a>
                        </div>
                        {!!Form::open(['action' => ['VenuesController@destroy', $venue->id], 'method' => 'POST', 'class' => 'delete'])!!}
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
        <p>Nevytvořili jste žádné místo</p>
    @endif
    

            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createVenueModal">
                    Vytvořit nové místo
            </button>

        
        
        
        @include('venues.create_modal')

    <a href="/home" role="button" class="btn btn-secondary">Zpět na hlavní panel</a>
    <script>
        $(".delete").on("submit", function(){
            return confirm("Opravdu chcete toto místo odstranit??");
        });
    </script>
    <script>
        $('#createVenueModal').on('hidden.bs.modal', function(){
            location.reload();
        })
    </script>
@endsection
