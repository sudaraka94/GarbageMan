<?php

namespace App\Http\Controllers;
use App\GarbageRecord;
use App\UserComplaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class user_controller extends Controller
{
    public function submit_record(Request $request){
        $rec=new GarbageRecord();
        $rec->weight=$request->amount;
        $rec->user_id=Auth::user()->getAuthIdentifier();
        $rec->save();
        return redirect()->route('home');
    }
    
    public function view_records(){
//        $records=Auth::user()->get_records();
        return view('user.view_records');
    }

    public function view_collection_records(){
//        $records=Auth::user()->get_records();
        return view('user.collection_logs');
    }

    public function view_complaint(){
//        $records=Auth::user()->get_records();
        return view('user.file_complaint');
    }
    
    public function post_complaint(Request $request){
        $com=new UserComplaint();
        $com->user_id=Auth::user()->getAuthIdentifier();
        $com->complaint=$request->complaint;
        $com->save();
        return redirect()->route('home');
    }

    public function get_complaints(){
//        $records=Auth::user()->get_records();
        return view('user.view_user_complaints');
    }
}
