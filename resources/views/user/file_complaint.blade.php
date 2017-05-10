@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">File Your Compaint</h3>
            </div>
            <div class="panel-body">
                <form action="{{route('post_complaint')}}" method="post">
                    <div class="form-group">
                        <label for="complaint">Please Enter Your Complaint</label>
                        <textarea name="complaint" class = "form-control" id="complaint" cols="40" rows="5"></textarea>
                    </div>
                    {{csrf_field()}}
                    <button type="submit" class="btn btn-default">Post</button>
                </form>
            </div>
        </div>
    </div>
@endsection