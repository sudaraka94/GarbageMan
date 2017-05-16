<?php

namespace App\Http\Controllers;

use App\Client;
use App\CollectionRecord;
use App\GarbageRecord;
use App\Truck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkerController extends Controller
{
    //    methods for truck managemant
    public function manage_col_rec(){
        $col_recs=CollectionRecord::get();
        return view('worker.manage_col_recs')->with('col_recs',$col_recs);
    }

    public function add_col_rec()
    {
        $clients=Client::get();
        return view('worker.add_col_rec')->with('clients',$clients);

    }

    public function post_add_col_rec(Request $request)
    {
        $this->validate($request, [
            'client_id' => 'required|integer|exists:client,id',
        ]);
        $col_rec=new CollectionRecord();
        $col_rec->client_id=$request->client_id;
        $col_rec->user_id=Auth::user()->getAuthIdentifier();
        $col_rec->truck_id=Auth::user()->truck_id;
        $col_rec->status=0;
        $col_rec->weight=0;
        $col_rec->save();
        $garbage_rec=GarbageRecord::where('client_id',$col_rec->client_id)->get();
        foreach ($garbage_rec as $rec){
            $rec->collected=1;
            $rec->save();
        }
        return redirect()->route('manage_col_rec');
    }

    public function get_edit_col_rec(Request $request)
    {
        $col_rec=CollectionRecord::where('id',$request->id)->first();
        return view('worker.add_col_rec')->with('edit',true)->with('col_rec',$col_rec);
    }

    public function edit_col_rec(Request $request)
    {
        $this->validate($request, [
            'registration_no' => 'required|string|max:255',
        ]);
        $col_rec=CollectionRecord::where('id',$request->id)->first();       
        $col_rec->client_id=$request->client_id;
        $col_rec->user_id=Auth::user()->getAuthIdentifier();
        $col_rec->truck_id=Auth::user()->truck_id;
        $col_rec->weight=0;
        $col_rec->status=0;
        $col_rec->save();
        return redirect()->route('manage_col_rec');
    }

    public function delete_col_rec(Request $request)
    {
        $col_rec=CollectionRecord::where('id',$request->id)->first();
        $col_rec->delete();
        return redirect()->route('manage_col_rec');
    }

    public function update_truck(Request $request)
    {
        $user=Auth::user();
        $user->truck_id=$request->truck_id;
        $user->save();
        return redirect()->route('home');
    }

    public function get_update_truck()
    {
        $trucks=Truck::get();
        return view('worker.update_truck')->with('trucks',$trucks);
    }
}
