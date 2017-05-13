<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function records(){
//        return GarbageRecord::where('user_id',Auth::user()->getAuthIdentifier())->get();
    return $this->hasMany('App\GarbageRecord');
    }
    public function collection_records(){
//        return GarbageRecord::where('user_id',Auth::user()->getAuthIdentifier())->get();
    return $this->hasMany('App\CollectionRecord');
    }
    
    public function user_complaints(){
//        return GarbageRecord::where('user_id',Auth::user()->getAuthIdentifier())->get();
    return $this->hasMany('App\UserComplaint');
    }

    //relationship with client
    public function client()
    {
        return $this->hasMany('App\Client');
    }

    //relationship with admin
    public function admin()
    {
        return $this->hasOne('App\Admin');
    }
}
