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
                <span id="errors_edit"></span> 
                {{ Form::open([]) }} 
                @csrf
                <div class="form-group">
                    {{Form::label('venue_name_input', 'Název místa')}} {{Form::text('venue_name_input', '', ['class' => 'form-control', 'placeholder'
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
    var venue_id = 0;
    $(".openEditVenueModalButton").click(function() {
        venue_id = $(this).data('venue_id');
        var name = $(this).data('name');
        var description = $(this).data('description');
        var street = $(this).data('street');
        var city = $(this).data('city');
        var zip = $(this).data('zip');
        var country = $(this).data('country');
        var lat = $(this).data('lat');
        var long = $(this).data('long');
        $("input[name=venue_name_input]").val(name);
        $("input[name=venue_description]").val(description);
        $("input[name=street]").val(street);
        $("input[name=city]").val(city);
        $("input[name=zip]").val(zip);
        $("input[name=country]").val(country);
        $("input[name=lat]").val(lat);
        $("input[name=long]").val(long);
    });

    $("#editVenueButton").click(function() {
    $("#errors_edit").html("");
    console.log(venue_id);
    var request = $.ajax({
            type: 'put',
            url: '/venues/'+venue_id,
            data: {
                '_token': '{{csrf_token()}}',
                'name': $('#editVenueModal input[name=venue_name_input]').val(),
                'description': $('#editVenueModal input[name=venue_description]').val(),
                'street': $('#editVenueModal input[name=street]').val(),
                'city': $('#editVenueModal input[name=city]').val(),
                'zip': $('#editVenueModal input[name=zip]').val(),
                'country': $('#editVenueModal input[name=country]').val(),
                'lat': $('#editVenueModal input[name=lat]').val(),
                'long': $('#editVenueModal input[name=long]').val()
            },
            success: function (data) {
                console.log(data);
                $('#editVenueModal').modal('hide');
                location.reload();
            },
            error: function (xhr, status, error) {
                console.log(xhr);
                $.each(xhr.responseJSON.errors, function (key, item)
          {
            $("#errors_edit").append("<div class='alert alert-danger'>"+item+"</div>")
          });
            }
        });

    });


</script>