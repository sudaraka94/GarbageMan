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
        @if(count($areas)==0)
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Sorry!</strong> There are no any areas for collecting garbge.
            </div>
            <a href="{{route('home')}}" class="btn btn-default">Back</a>
        @endif
        <div class="row">
            @for($i=0; $i<count($areas); $i++)
            <div class="col-sm-6 col-md-3">
                <a href="{{route('view_path',['area'=>$areas[$i]->id])}}">
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
