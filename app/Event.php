<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //Table Name
    protected $table = 'events';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;   


    public function venue()
    {
        return $this->belongsTo('App\Venue');
    }


    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function event_category()
    {
        return $this->belongsToMany('App\Event_category', 'event_event_category');
    }

}
