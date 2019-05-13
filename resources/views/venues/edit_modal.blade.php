<div class="modal fade" id="editVenueModal" tabindex="-1" role="dialog" aria-labelledby="editVenueModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editVenueModalLabel">Upravit místo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <span id="errors"></span> 
                {{ Form::open([]) }} 
                @csrf
                <div class="form-group">
                    {{Form::label('venue_name_input', 'Název místa')}} {{Form::text('venue_name_input', $venue->name, ['class' => 'form-control', 'placeholder'
                    => 'Název místa'])}}
                </div>
                <div class="form-group">
                    {{Form::label('venue_description', 'Popis místa')}} {{Form::text('venue_description', '', ['class' => 'form-control', 'placeholder'
                    => 'Popis místa'])}}
                </div>
                <h4>Adresa</h4>
                <div class="container">
                    <div class="row">
                        <div class="form-group col pl-0">
                            {{Form::label('street', 'Ulice')}} {{Form::text('street', null, ['class' => 'form-control', 'placeholder' => 'Ulice']) }}
                        </div>
                        <div class="form-group col pr-0">
                            {{Form::label('city', 'Město')}} {{Form::text('city', null, ['class' => 'form-control', 'placeholder' => 'Město']) }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col pl-0">
                            {{Form::label('zip', 'PSČ')}} {{Form::text('zip', null, ['class' => 'form-control', 'placeholder' => 'PSČ']) }}
                        </div>
                        <div class="form-group col pr-0">
                            {{Form::label('country', 'Stát')}} {{Form::text('country', null, ['class' => 'form-control', 'placeholder' => 'Stát']) }}
                        </div>
                    </div>
                </div>
                <h4>Mapa</h4>
                <div class="container">
                    <div class="row">
                        <div class="form-group col pl-0">
                            {{Form::label('lat', 'Zeměpisná šířka')}} {{Form::text('lat', null, ['class' => 'form-control', 'placeholder' => 'Zeměpisná šířka']) }}
                        </div>
                        <div class="form-group col pr-0">
                            {{Form::label('long', 'Zeměpisná délka')}} {{Form::text('long', null, ['class' => 'form-control', 'placeholder' => 'Zeměpisná délka']) }}
                        </div>
                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Zrušit</button>
                <button type="button" id="editVenueButton" class="btn btn-primary">Uložit změny</button> {{ Form::close()
                }}
            </div>
        </div>
    </div>
</div>



<script>
    $("#editVenueButton").click(function() {
    $("#errors").html("");
    var request = $.ajax({
            type: 'post',
            url: '/venues/storeModal',
            data: {
                '_token': '{{csrf_token()}}',
                'name': $('input[name=venue_name_input]').val(),
                'description': $('input[name=venue_description]').val(),
                'street': $('input[name=street]').val(),
                'city': $('input[name=city]').val(),
                'zip': $('input[name=zip]').val(),
                'country': $('input[name=country]').val(),
                'lat': $('input[name=lat]').val(),
                'long': $('input[name=long]').val()
            },
            success: function (data) {
                console.log(data);
                $('#createVenueModal').modal('hide');
                $('#venue_name_livesearch').val($('input[name=venue_name_input]').val());
            },
            error: function (xhr, status, error) {
                $.each(xhr.responseJSON.errors, function (key, item) 
          {
            $("#errors").append("<div class='alert alert-danger'>"+item+"</div>")
          });
            }
        });

    });


</script>