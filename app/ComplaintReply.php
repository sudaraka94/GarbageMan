<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComplaintReply extends Model
{
    public function user_complaint()
    {
        return $this->belongsTo('App\UserComplaint');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
