<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Council extends Model
{
//many to many wiht admin
    public function admin()
    {
        return $this->hasMany('App\Admin');
    }

    public function truck()
    {
        return $this->hasMany('App\Truck');
    }

}
