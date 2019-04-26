<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
         //Table Name
         protected $table = 'venues';
         // Primary Key
         public $primaryKey = 'id';
         // Timestamps
         public $timestamps = true;  
    


    public function event(){
        return $this->hasMany('App\Event');
    }
}
