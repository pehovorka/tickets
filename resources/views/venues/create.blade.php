
@extends('layouts.app')

@section('content')
{{ Form::open(['action' => 'VenuesController@store', 'method' => 'POST']) }}
<div class="form-group">
        {{Form::label('name', 'Název místa')}}
        {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Název místa'])}}
</div>
<div class="form-group">
        {{Form::label('description', 'Popis místa')}}
        {{Form::text('description', '', ['class' => 'form-control', 'placeholder' => 'Popis místa'])}}
</div>
<h4>Adresa</h4>
<div class="container">
        <div class="row">
            <div class="form-group col pl-0">
                {{Form::label('street', 'Ulice')}}
                {{Form::text('street', null, ['class' => 'form-control', 'placeholder' => 'Ulice']) }}
            </div>
            <div class="form-group col pr-0">
                {{Form::label('city', 'Město')}}
                {{Form::text('city', null, ['class' => 'form-control', 'placeholder' => 'Město']) }}
            </div>
        </div>
        <div class="row">
                <div class="form-group col pl-0">
                    {{Form::label('zip', 'PSČ')}}
                    {{Form::text('zip', null, ['class' => 'form-control', 'placeholder' => 'PSČ']) }}
                </div>
                <div class="form-group col pr-0">
                    {{Form::label('country', 'Stát')}}
                    {{Form::text('country', null, ['class' => 'form-control', 'placeholder' => 'Stát']) }}
                </div>
            </div>
    </div>
<h4>Mapa</h4>
<div class="container">
        <div class="row">
            <div class="form-group col pl-0">
                {{Form::label('lat', 'Zeměpisná šířka')}}
                {{Form::text('lat', null, ['class' => 'form-control', 'placeholder' => 'Zeměpisná šířka']) }}
            </div>
            <div class="form-group col pr-0">
                {{Form::label('long', 'Zeměpisná délka')}}
                {{Form::text('long', null, ['class' => 'form-control', 'placeholder' => 'Zeměpisná délka']) }}
            </div>
        </div>
    </div>

    {{Form::submit('Uložit nové místo', ['class'=>'btn btn-primary'])}}
    {{ Form::close() }}




@endsection