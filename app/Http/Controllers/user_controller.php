<?php

namespace App\Http\Controllers;
use App\GarbageRecord;
use App\UserComplaint;
use App\ComplaintReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class user_controller extends Controller
{
    public function submit_record(Request $request){
        $rec=new GarbageRecord();
        $rec->weight=$request->amount;
        $rec->client_id=Auth::user()->client->id;
        $rec->save();
        return redirect()->route('view_records');
    }
    
    public function view_records(){
        $client=Auth::user()->client->records;
        return view('user.view_records')->with('records',$client);
    }

    public function delete_record(Request $request){
        $record=GarbageRecord::where('id',$request->id);
        $record->delete();
        return redirect()->route('view_records');
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

    public function chat($complaint_id=null)
    {
        if($complaint_id==null){
            $complaint_sel=UserComplaint::get()->first();
        }else{
            $complaint_sel=UserComplaint::where('id',$complaint_id)->get()->first();
        }
        $complaint_sel->new=0;
        $complaint_sel->save();
        $complaints=UserComplaint::where('user_id',Auth::user()->getAuthIdentifier())->get();
        return view('user.chat')->with('complaints',$complaints)->with('complaint_sel',$complaint_sel);
    }

    public function post_reply(Request $request)
    {
        
        $reply= new ComplaintReply();
        $reply->user_complaint_id=$request->complaint_id;
        $reply->message=$request->complaint;
        $reply->user_id=Auth::user()->getAuthIdentifier();
        $reply->save();
        $complaint=$reply->user_complaint;
        $complaint->admin_new=1;
        $complaint->save();
        return redirect()->route('user_complaints',['complaint_id'=>$request->complaint_id]);
    }
}
