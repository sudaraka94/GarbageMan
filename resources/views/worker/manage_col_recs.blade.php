@extends('layouts.app')
@section('content')
    <div class="container">
        <div style="text-align: center">
            <h1>Manage Areas</h1>
        </div>
        <a href="{{route('add_area')}}" type="button" class="btn btn-info">Add Area</a>
        <br><br>
        <table class="table" width="100%">
            <tr>
                <th width="20%">User ID</th>
                <th width="20%">Name</th>
                <th width="10%"></th>
                <th width="10%"></th>
            </tr>
            @foreach($areas as $area)
                <tr>
                    <td>{{$area->id}}</td>
                    <td>{{$area->name}}</td>
                    <td>
                        <form action="{{route('edit_area')}}" method="get">
                            {{csrf_field()}}
                            <input type="hidden" value="{{$area->id}}" name="id">
                            <input type="submit" value="Edit" class="btn btn-success">
                        </form>
                    </td>
                    <td>
                        <form action="{{route('delete_area')}}">
                            {{csrf_field()}}
                            <input type="hidden" value="{{$area->id}}" name="id">
                            <input type="submit" value="Delete" class="btn btn-danger">
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection