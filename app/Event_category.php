<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event_category extends Model
{
    //Table Name
    protected $table = 'event_categories';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;   



    public function event()
    {
        return $this->belongsToMany('App\Event', 'event_event_category');
    }
}

