<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GarbageRecord extends Model
{
    protected $table='garbage_record';

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
