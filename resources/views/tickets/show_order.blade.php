@extends('layouts.app')


@section('content')
    <h1>Koupit vstupenky – {{$ticket->event->name}}</h1>
    
    <hr>
      <div class="row">
        <div class="col-lg">
                
                <div class="card">
                        <div class="card-header">{{$ticket->name}} ({{number_format($ticket->price, 0, ',', ' ')}} Kč za jednu vstupenku)</div>
                        <div class="card-body">
                                {{ Form::open(['action' => ['TicketsController@showOrder', $ticket->id], 'method' => 'POST']) }}
                                <h4>Počet vstupenek</h4>
                                <div class="quantityContainer row p-4">
                                        <span class="minus btn btn-secondary col-1 mr-2">-</span>
                                        {{Form::number('quantity', $quantity, ['id' => 'quantityInput', 'class' => 'form-control input-number text-center col-2', 'placeholder' => '1', 'required', 'disabled', 'min' => '1', 'max' => '10'])}}
                                        <span class="plus btn btn-secondary col-1 ml-2">+</span>
                                        <div id="price" class="col-4 text-center ticketText pt-1">{{$quantity*$ticket->price}} Kč</div>
                                    </div>
                                <hr>
                                <h4>Platební metoda</h4>
                                @foreach ($paymentMethods as $method)
                                    <div class="form-check">
                                        {{Form::radio('payment_type','method_'.$method->id, false, ['class' => 'form-check-input', 'id' => 'method_'.$method->id]) }}
                                        {{Form::label('method_'.$method->id, $method->name, ['class' => 'form-check-label'])}}
                                    </div>
                                @endforeach
                                {{Form::submit('Koupit', ['class'=>'btn btn-primary buy mt-3'])}}
                                {{ Form::close() }}
                    </div>
                    </div>
                    
        </div>
        <div class="col col-lg-3">
            <div class="card">
                <div class="card-header">Dodatečné informace</div>
                <div class="card-body">
                <P>Vaše jméno: <strong>{{Auth::user()->first_name.' '.Auth::user()->last_name}}</strong></P>
                <p>Zakoupené vstupenky naleznete ve vašem uživatelském panelu a budou zaslány na e-mail <strong>{{Auth::user()->email}}</strong>.</p>
            </div>
            </div>
            </div>
      </div>
    
    <script>
         $(document).ready(function(){
            var price = {{$ticket->price}};
            $(document).on('click','.plus',function(){
                    if ($('#quantityInput').val() < 10) {
                        $('#quantityInput').val(parseInt($('#quantityInput').val()) + 1 ).change();
                    }
    		});
        	$(document).on('click','.minus',function(){
                    if ($('#quantityInput').val() > 1) {
                        $('#quantityInput').val(parseInt($('#quantityInput').val()) - 1 ).change();
                    }
                });
                $('#quantityInput').change(function(){
                var quantity = $('input[name=quantity').val();
                var finalPrice = quantity*price;
                $('#price').html(finalPrice+' Kč');
            });
         });

    </script>
    
@endsection
