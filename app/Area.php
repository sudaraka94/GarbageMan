<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    public function council()
    {
        return $this->belongsTo('App\Council');
    }
    
    //return the collection points belongs to the area
    public function client()
    {
        return $this->hasMany('App\Client');
    }
}
