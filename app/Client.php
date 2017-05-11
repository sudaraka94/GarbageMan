<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table='client';
    
//    one to one relationship
    public function user()
    {
        return $this->hasOne('App\User' );
    }
}

