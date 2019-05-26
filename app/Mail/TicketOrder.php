<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use App\Transaction;

class TicketOrder extends Mailable
{
    use Queueable, SerializesModels;
    public $transaction; 
    public $sum_price; 

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Transaction $transaction, $sum_price)
    {
        $this->transaction = $transaction;
        $this->sum_price = $sum_price;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $tickets = $this->transaction->ticket_user;
        return $this->view('emails.ticket_order')->with('tickets', $tickets)->subject($tickets[0]->original_event_name.' – vstupenky z portálu KupVstup');
    }
}
