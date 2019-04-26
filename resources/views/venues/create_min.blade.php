<li><button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#yourModal"></li>

    <div class="modal fade" id="yourModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Přidat nové místo</h4>
          </div>
          <div class="modal-body">



{{ Form::open(['action' => 'VenuesController@store', 'method' => 'POST']) }}
<div class="form-group">
        {{Form::label('venue_name', 'Název místa')}}
        {{Form::text('venue_name', '', ['class' => 'form-control', 'placeholder' => 'Název místa'])}}
</div>
<div class="form-group">
        {{Form::label('venue_description', 'Popis místa')}}
        {{Form::text('venue_description', '', ['class' => 'form-control', 'placeholder' => 'Popis místa'])}}
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




</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">Zrušit</button>
  {{Form::submit('Uložit nové místo', ['class'=>'btn btn-primary'])}}
  {{ Form::close() }}
</div>
</div>
</div>
</div>