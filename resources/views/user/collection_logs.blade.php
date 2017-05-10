@extends('layouts.app')
@section('content')
    <div class="container">
        <div style="text-align: center">
            <h1>Your Garbage Collection Logs</h1>
        </div>
        <br><br>
        <table class="table" width="100%">
            <tr>
                <th width="30%">Weight</th>
                <th width="30%">Collected Date</th>
                <th width="30%">Truck ID</th>
            </tr>
            @foreach(Auth::user()->collection_records as $record)
                <tr>
                    <td>{{$record->weight}} kg</td>
                    <td>{{$record->created_at}}</td>
                    <td>{{$record->truck_id}}</td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection