@extends('layouts.app')

@section('head')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/locale/cs.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>  
@endsection

@section('content')
<h1>Vytvořit akci</h1>
{{ Form::open(['action' => 'EventsController@store', 'method' => 'POST']) }}
<div class="form-group">
    {{Form::label('name', 'Název')}}
    {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Název'])}}
</div>
<div class="form-group">
    {{Form::label('description', 'Popis')}}
    {{Form::textarea('description', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Popis'])}}
</div>
<div class="container">
    <div class="row">
        <div class="form-group col pl-0">
               {{Form::label('date_from', 'Datum od')}}
            {{Form::text('date_from', null, ['class' => 'form-control date', 'id'=>'datepicker']) }}
        </div>
        <div class="form-group col pr-0">
            {{Form::label('date_to', 'Datum do')}}
            {{Form::text('date_to', null, ['class' => 'form-control date', 'id'=>'datepicker2']) }}
        </div>
    </div>
</div>
<hr>
<h2>Místo konání</h2>
<div>
    @include('venues.livesearch')
    <a class="btn btn-primary" href="/venues/create" target="_blank">Vytvořit nové místo</a>
</div>


{{Form::submit('Odeslat', ['class'=>'btn btn-primary'])}}
{{ Form::close() }}





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
