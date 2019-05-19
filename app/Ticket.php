<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
 
    public function event()
    {
        return $this->belongsTo('App\User');
    }

}
