<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    public function council()
    {
        return $this->belongsTo('App\Council');
    }
    
    //return the collection points belongs to the area
    public function client()
    {
        return $this->hasMany('App\Client');
    }

    public function garbageRecord()
    {
        return $this->hasMany('App\GarbageRecord');
    }

    public function get_garbage_amount()
    {
        $clients=$this->client;
        $tot_weight=0;
        foreach ($clients as $client){
            $garbage_records=GarbageRecord::where('client_id',$client->id)->get();
            foreach ($garbage_records as $record){
                if($record->collected==0) {
                    $tot_weight = $tot_weight + $record->weight;
                }
            }
        }
        return $tot_weight;
    }


    //this method returns only the places with garbage records
    public function get_active_points()
    {
        $clients=$this->client;
        $with_garb=[];
        foreach ($clients as $client){
            $garbage_records=GarbageRecord::where('client_id',$client->id)->get();
            $tot_weight=0;
            foreach ($garbage_records as $record){
                if($record->collected==0) {
                    $tot_weight = $tot_weight + $record->weight;
                }
            }
            if($tot_weight>0){
                array_push($with_garb,$client);
            }
        }
        return $with_garb;
    }
}
