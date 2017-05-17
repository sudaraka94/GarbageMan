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
    @if(Auth::check())
        <h1>Welcome to {{$council->name}}</h1>
        @if(Auth::user()->type=="USER" and $client!=null)
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
                    <a href="{{route('user_complaints')}}">
                        <div class="thumbnail">
                            {{--<img src="..." alt="...">--}}
                            <div class="caption">
                                <h3>View Complaints</h3>
                                @if($recent_activity==true) <span class="label label-success">New Messeges</span> @endif
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        @elseif(Auth::user()->type=="USER")
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Alert!</strong> No collection points have been registered in your name. Some functions may not be available.
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
        @elseif(Auth::user()->type=="ADMIN")
            <div class="row">
                <div class="col-sm-6 col-md-3">
                    <a href="{{route('admin_complaints')}}">
                        <div class="thumbnail">
                            {{--<img src="..." alt="...">--}}
                            <div class="caption">
                                <h3>View Complaints</h3>
                                @if($recent_activity==true) <span class="label label-success">New Messeges</span> @endif
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
                <div class="col-sm-6 col-md-3">
                    <a href="{{route('manage_collection_points')}}">
                        <div class="thumbnail">
                            {{--<img src="..." alt="...">--}}
                            <div class="caption">
                                <h3>Manage Collection Points</h3>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-md-3">
                    <a href="{{route('view_route')}}">
                        <div class="thumbnail">
                            {{--<img src="..." alt="...">--}}
                            <div class="caption">
                                <h3>View Collection Route</h3>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-md-3">
                    <a href="{{route('edit_council_pos_get')}}">
                        <div class="thumbnail">
                            {{--<img src="..." alt="...">--}}
                            <div class="caption">
                                <h3>Edit Council Details</h3>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-md-3">
                    <a href="{{route('manage_areas')}}">
                        <div class="thumbnail">
                            {{--<img src="..." alt="...">--}}
                            <div class="caption">
                                <h3>Manage Collection Areas</h3>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-md-3">
                    <a href="{{route('manage_trucks')}}">
                        <div class="thumbnail">
                            {{--<img src="..." alt="...">--}}
                            <div class="caption">
                                <h3>Manage Trucks</h3>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        @elseif(Auth::user()->type=="WORKER")
            @if(Auth::user()->truck_id==null)
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Alert!</strong> Please update Your Truck before proceed
                </div>
            @endif
            @if(Auth::user()->truck_id!=null)
            <div class="col-sm-6 col-md-3">
                <a href="{{route('add_col_rec')}}">
                    <div class="thumbnail">
                        {{--<img src="..." alt="...">--}}
                        <div class="caption">
                            <h3>Add Collection Records</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-md-3">
                <a href="{{route('manage_col_rec')}}">
                    <div class="thumbnail">
                        {{--<img src="..." alt="...">--}}
                        <div class="caption">
                            <h3>Manage Collection Records</h3>
                        </div>
                    </div>
                </a>
            </div>
            @endif
            <div class="col-sm-6 col-md-3">
                <a href="{{route('update_truck')}}">
                    <div class="thumbnail">
                        {{--<img src="..." alt="...">--}}
                        <div class="caption">
                            <h3>Update Truck</h3>
                        </div>
                    </div>
                </a>
            </div>
        @endif
    @else
        <h1>Welcome to GarbageMan</h1>
        <h3>Login to proceed</h3>
    @endif
</div>
@endsection
