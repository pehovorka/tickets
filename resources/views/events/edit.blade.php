@extends('layouts.app')

@section('head')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/locale/cs.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>  
@endsection

@section('content')
<h1>Upravit akci</h1>
{{ Form::open(['action' => ['EventsController@update', $event->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
<div class="form-group">
    {{Form::label('name', 'Název')}}
    {{Form::text('name', $event->name, ['class' => 'form-control', 'placeholder' => 'Název'])}}
</div>
<div class="form-group">
    {{Form::label('description', 'Popis')}}
    {{Form::textarea('description', $event->description, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Popis'])}}
</div>
<div class="container">
    <div class="row">
        <div class="form-group col">
               {{Form::label('date_from', 'Datum od')}}
            {{Form::text('date_from', $event->date_from, ['class' => 'form-control date', 'id'=>'datepicker']) }}
        </div>
        <div class="form-group col">
            {{Form::label('date_to', 'Datum do')}}
            {{Form::text('date_to', $event->date_to, ['class' => 'form-control date', 'id'=>'datepicker2']) }}
        </div>
    </div>
</div>
<div>Úvodní obrázek</div>
<div class="form-group">
    {{Form::file('img')}}
</div>
<hr>
<h2>Místo konání</h2>
<div class="row">
    <div class="col-12 col-sm-6 col-md-8">
        <div class="form-group">
                {{Form::text('venue_name_livesearch', $event->venue->name, ['class' => 'form-control input-lg', 'id' => 'venue_name_livesearch', 'placeholder' => 'Vyhledat...'])}}
                <div id="venuesList"></div>
        </div>
        @include('venues.livesearch')
    </div>
    <div class="col-6 col-md-4">
        
        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#createVenueModal">
                Neexistuje? Vytvořit nové místo!
        </button>
    </div>
</div>

{{Form::hidden('_method','PUT')}}
{{Form::submit('Odeslat', ['class'=>'btn btn-primary'])}}
{{ Form::close() }}



@include('venues.create_modal')

<script>
    var route_prefix = "{{ url(config('lfm.url_prefix', config('lfm.prefix'))) }}";

</script>
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script>
    var options = {
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{ csrf_token() }}',
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{ csrf_token() }}'
    };

</script>
<script>
    CKEDITOR.replace('article-ckeditor', options);
</script>
<script type="text/javascript">
    $('.date').datetimepicker({
        locale: 'cs',
        format: 'YYYY-MM-DD'
    }); 
</script>  
@endsection
