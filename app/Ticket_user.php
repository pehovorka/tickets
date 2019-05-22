<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket_user extends Model
{
    public function ticket()
    {
        return $this->belongsTo('App\Ticket');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function transaction()
    {
        return $this->belongsTo('App\Transaction');
    }
}
