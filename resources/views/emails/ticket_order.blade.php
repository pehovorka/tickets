<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vstupenky z portálu KupVstup</title>
</head>

<body>
    <h1>{{$tickets[0]->original_event_name}}</h1>
    <p>Děkujeme za nákup na portálu KupVstup!</p>

    <h3>Zakoupené vstupenky</h3>
    <ol>
        @foreach($tickets as $ticket)
        <li><a href="{{route('showTicket',$ticket->uuid)}}">{{$ticket->original_name.' ('.$ticket->original_price.' Kč)'}}</a></li>
        @endforeach
    </ol>

    <h3>Detaily transakce</h3>
    <ul>
        <li>Celková cena: {{$sum_price}} Kč</li>
        <li>Datum nákupu: {{$transaction->date}}</li>
        <li>Platební metoda: {{$transaction->payment_method->name}}</li>
        <li>ID transakce: {{$transaction->id}}</li>
    </ul>
    <p>Upozornění: Tyto vstupenky nejsou platné, KupVstup je semestrální práce Petra Hovorky z kurzu 4IZ278 na Vysoké škole
        ekonomické v Praze!</p>
</body>

</html>