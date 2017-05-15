<?php

namespace App\Http\Controllers;

use App\Client;
use App\Council;
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
        $council=Council::get()->first();
        $client=Client::where('user_id',Auth::user()->getAuthIdentifier())->first();
        return view('home')->with('council',$council)->with('client',$client);
    }
}
