<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table='client';
    
//    one to one relationship
    public function user()
    {
        return $this->belongsTo('App\User' );
    }
    
    //many to one with zrea
    public function area()
    {
        return $this->belongsTo('App\Area' );
    }
}

