<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CollectionRecord extends Model
{
    protected $table='collection_record';

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function truck()
    {
        return $this->belongsTo('App\Truck');
    }
}
