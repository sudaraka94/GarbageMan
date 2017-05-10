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
    </div>
@endsection
