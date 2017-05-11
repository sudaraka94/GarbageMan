<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    //    one to one relationship
    public function user()
    {
        return $this->hasOne('App\User' );
    }

    public function council()
    {
        return $this->belongsTo('App\Council');
    }
}
