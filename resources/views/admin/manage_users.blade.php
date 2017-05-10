@extends('layouts.app')
@section('content')
    <div class="container">
        <div style="text-align: center">
            <h1>Manage Users</h1>
        </div>
        <a href="{{route('add_user')}}" type="button" class="btn btn-info">Add User</a>
        <br><br>
        <table class="table" width="100%">
            <tr>
                <th width="20%">User ID</th>
                <th width="20%">Name</th>
                <th width="20%">Email</th>
                <th width="20%">Type</th>
                <th width="10%"></th>
                <th width="10%"></th>
            </tr>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->type}}</td>
                    <td>
                        <form action="{{route('get_user_edit')}}" method="get">
                            {{csrf_field()}}
                            <input type="hidden" value="{{$user->id}}" name="id">
                            <input type="submit" value="Edit" class="btn btn-success">
                        </form>
                    </td>
                    <td>
                        <form action="{{route('delete_user')}}">
                            {{csrf_field()}}
                            <input type="hidden" value="{{$user->id}}" name="id">
                            <input type="submit" value="Delete" class="btn btn-danger">
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection