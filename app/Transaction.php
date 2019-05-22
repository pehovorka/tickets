<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function payment_method()
    {
        return $this->belongsTo('App\Payment_method');
    }

    public function ticket_user()
    {
        return $this->hasMany('App\Ticket_user');
    }
}
