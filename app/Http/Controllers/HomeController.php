<?php

namespace App\Http\Controllers;

use App\Client;
use App\Council;
use App\UserComplaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recent_activity=false;
        if (Auth::user()->type=='ADMIN'){
            $complaints=UserComplaint::get();
            foreach ($complaints as $complaint){
                if($complaint->admin_new==1){
                    $recent_activity=true;
                }
            }
        }
        elseif (Auth::user()->type=='USER'){
            $complaints=UserComplaint::get();
            foreach ($complaints as $complaint){
                if($complaint->new==1){
                    $recent_activity=true;
                }
            }
        }
        $council=Council::get()->first();
        $client=Client::where('user_id',Auth::user()->getAuthIdentifier())->first();
        return view('home')->with('council',$council)->with('recent_activity',$recent_activity)->with('client',$client);
    }
}
