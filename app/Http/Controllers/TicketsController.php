<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Ticket;
use App\Payment_method;
use App\Ticket_user;
use App\Transaction;

class TicketsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, Request $request)
    {
        $this->validate($request, [
            'quantityInput' => 'required|numeric|between:1,10',
            'user_message' => 'max:255',
            'payment_method' => 'required',
        ]);
        $ticket = Ticket::find($id);
        $quantity = $request->input('quantityInput');
        
        //Transaction
        $transaction = new Transaction;
        $transaction->payment_method_id = $request->input('payment_method');
        $transaction->date = now();
        $transaction->save();

        //Ticket_user
        foreach(range(1,$quantity) as $index) {
            $ticket_user = new Ticket_user;
            $ticket_user->uuid = (string) Str::uuid();
            //Store original information
            $ticket_user->original_name = $ticket->name;
            $ticket_user->original_price = $ticket->price;
            $ticket_user->original_event_name = $ticket->event->name;
            if(isset($ticket->event->venue)){
                $ticket_user->original_venue_name = $ticket->event->venue->name;
            };
            $ticket_user->original_user_first_name = auth()->user()->first_name;
            $ticket_user->original_user_last_name = auth()->user()->last_name;
            $ticket_user->original_user_email = auth()->user()->email;
            //FK
            $ticket_user->ticket_id = $ticket->id;
            $ticket_user->event_id = $ticket->event->id;
            $ticket_user->transaction_id = $transaction->id;
            $ticket_user->user_id = auth()->user()->id;
            //User comment
            $ticket_user->user_comment =  $request->input('user_message');;
            //Save
            $ticket_user->save();
        }

        return redirect('/home/tickets')->with('success', 'Děkujeme za nákup!');
    }

    /**
     * Display the specified resource.
     *
     * @param  uuid  $uuid
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $ticket_user = Ticket_user::where('uuid', $uuid)->firstOrFail();
        return view('tickets.show')->with('ticket_user',$ticket_user);
    }

    /**
     * Validate ticket.
     *
     * @param  uuid  $uuid
     * @return \Illuminate\Http\Response
     */
    public function validateTicket(Request $request, $uuid)
    {
        $request->user()->authorizeRoles(['administrator', 'manager']);
        $ticket_user = Ticket_user::where('uuid', $uuid)->firstOrFail();
        return view('tickets.validate')->with('ticket_user',$ticket_user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function useTicket(Request $request)
    {
        $request->user()->authorizeRoles(['administrator', 'manager']);
        $ticket_user = Ticket_user::where('uuid', $request->uuid)->firstOrFail();
        $ticket_user->used = now();
        $ticket_user->save();
        return redirect('/tickets/validate/'.$ticket_user->uuid)->with('success', 'Vstupenka byla použita!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Buy specified ticket.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showOrder($id, Request $request)
    {
        $ticket = Ticket::find($id);
        $paymentMethods = Payment_method::all();
        if ($request->quantity){
            $quantity = $request->quantity;
        }
        else {$quantity = 1;}
        return view('tickets.show_order')->with(['ticket' => $ticket, 'quantity'=> $quantity, 'paymentMethods'=> $paymentMethods]);
            
    }
}
