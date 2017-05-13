@extends('layouts.app')
@section('content')
    <div class="container">
        <div style="text-align: center">
            <h1>Manage Trucks</h1>
        </div>
        <a href="{{route('add_truck')}}" type="button" class="btn btn-info">Add Truck</a>
        <br><br>
        <table class="table" width="100%">
            <tr>
                <th width="20%">Truck ID</th>
                <th width="20%">Registration No</th>
                <th width="10%"></th>
                <th width="10%"></th>
            </tr>
            @foreach($trucks as $truck)
                <tr>
                    <td>{{$truck->id}}</td>
                    <td>{{$truck->registration_no}}</td>
                    <td>
                        <form action="{{route('edit_truck')}}" method="get">
                            {{csrf_field()}}
                            <input type="hidden" value="{{$truck->id}}" name="id">
                            <input type="submit" value="Edit" class="btn btn-success">
                        </form>
                    </td>
                    <td>
                        <form action="{{route('delete_truck')}}">
                            {{csrf_field()}}
                            <input type="hidden" value="{{$truck->id}}" name="id">
                            <input type="submit" value="Delete" class="btn btn-danger">
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection