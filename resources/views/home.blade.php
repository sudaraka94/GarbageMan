@extends('layouts.app')
@section('styles')
    <style>
        .thumbnail{
            background-color: white;
            margin: 4%;
            height: 150px;
        }
    </style>
@endsection
@section('content')
<div class="container">
    {{--<div class="container">--}}
    {{--<div class="row">--}}
    {{--<div class="col-md-8 col-md-offset-2">--}}
    {{--<div class="panel panel-default">--}}
    {{--<div class="panel-heading">Dashboard</div>--}}

    {{--<div class="panel-body">--}}
    {{--You are logged in!--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    @if(Auth::check())
        @if(Auth::user()->type=="USER")
            <div class="row">
                <div class="col-sm-6 col-md-3">
                    <a href="{{route('add_garbage')}}">
                        <div class="thumbnail">
                            {{--<img src="..." alt="...">--}}
                            <div class="caption">
                                <h3>Add Garbage Record</h3>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-md-3">
                    <a href="{{route('view_records')}}">
                        <div class="thumbnail">
                            {{--<img src="..." alt="...">--}}
                            <div class="caption">
                                <h3>View Garbage Records</h3>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-md-3">
                    <a href="{{route('view__collection_records')}}">
                        <div class="thumbnail">
                            {{--<img src="..." alt="...">--}}
                            <div class="caption">
                                <h3>Garbage Collection Logs</h3>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-md-3">
                    <a href="">
                        <div class="thumbnail">
                            {{--<img src="..." alt="...">--}}
                            <div class="caption">
                                <h3>Edit Profile</h3>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-md-3">
                    <a href="{{route('view_complaint')}}">
                        <div class="thumbnail">
                            {{--<img src="..." alt="...">--}}
                            <div class="caption">
                                <h3>File a complaint</h3>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-md-3">
                    <a href="{{route('get_complaints')}}">
                        <div class="thumbnail">
                            {{--<img src="..." alt="...">--}}
                            <div class="caption">
                                <h3>View Complaints</h3>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        @elseif(Auth::user()->type=="ADMIN")
            <div class="row">
                <div class="col-sm-6 col-md-3">
                    <a href="{{route('get_all_complaints')}}">
                        <div class="thumbnail">
                            {{--<img src="..." alt="...">--}}
                            <div class="caption">
                                <h3>View Complaints</h3>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-md-3">
                    <a href="{{route('manage_users')}}">
                        <div class="thumbnail">
                            {{--<img src="..." alt="...">--}}
                            <div class="caption">
                                <h3>Manage Users</h3>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        @elseif(Auth::user()->type=="WORKER")
        @endif
    @else
        <h1>Welcome to GarbageMan</h1>
        <h3>Login to proceed</h3>
    @endif
</div>
@endsection
