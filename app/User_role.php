<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_role extends Model
{
     //Table Name
     protected $table = 'user_roles';
     // Primary Key
     public $primaryKey = 'id';
     // Timestamps
     public $timestamps = true;   

    public function user(){
        return $this->hasMany('App\User');
    }
}
