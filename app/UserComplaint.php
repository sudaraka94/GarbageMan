<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserComplaint extends Model
{
    protected $table='user_complaint';

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function complaint_replies()
    {
        return $this->hasMany('App\ComplaintReply');
    }
}
