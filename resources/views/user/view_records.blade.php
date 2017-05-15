@extends('layouts.app')
@section('content')
    <div class="container">
        <div style="text-align: center">
            <h1>Your Garbage Records</h1>
        </div>
        <a href="{{route('add_garbage')}}" class="btn btn-info">Add Record</a>
        <br><br>
        <table class="table" width="100%">
            <tr>
                <th width="45%">Weight</th>
                <th width="45%">Added Date</th>
                <th width="10%"></th>
            </tr>
            @foreach($records as $record)
            <tr>
                <td>{{$record->weight}} kg</td>
                <td>{{$record->created_at}}</td>
                <td>
                    <form method="post" action="{{route('delete_garbage')}}">
                        {{csrf_field()}}
                        <input type="hidden" value="{{$record->id}}" name="id">
                        <input type="submit" value="Delete" class="btn btn-danger"></form></td>
            </tr>
                @endforeach
        </table>
    </div>
@endsection