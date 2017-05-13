@extends('layouts.app')
@section('content')
    <div class="container">
        <div style="text-align: center">
            <h1>Manage Collection Points</h1>
        </div>
        <a href="{{route('add_collection_point')}}" type="button" class="btn btn-info">Add New Collection Point</a>
        <br><br>
        <table class="table" width="100%">
            <tr>
                <th width="20%">Client Name</th>
                <th width="20%">Address</th>
                <th width="20%">Area</th>
                <th width="10%"></th>
                <th width="10%"></th>
            </tr>
            @foreach($clients as $client)
                <tr>
                    <td>{{$client->user->name}}</td>
                    <td>{{$client->address}}</td>
                    <td>{{$client->area->name}}</td>
                    <td>
                        <form action="{{route('edit_collection_point')}}" method="get">
                            {{csrf_field()}}
                            <input type="hidden" value="{{$client->id}}" name="id">
                            <input type="submit" value="Edit" class="btn btn-success">
                        </form>
                    </td>
                    <td>
                        <form action="{{route('delete_collection_point')}}">
                            {{csrf_field()}}
                            <input type="hidden" value="{{$client->id}}" name="id">
                            <input type="submit" value="Delete" class="btn btn-danger">
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection