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
            @for($i=0; $i<count($areas); $i++)
            <div class="col-sm-6 col-md-3">
                <a href="">
                    <div class="thumbnail">
                        {{--<img src="..." alt="...">--}}
                        <div class="caption">
                            <h3>Route for {{$trucks[$i]->registration_no}} truck</h3>
                        </div>
                    </div>
                </a>
            </div>
            @endfor
        </div>
    </div>
@endsection
