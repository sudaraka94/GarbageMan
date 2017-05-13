@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Add Truck</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="@if(isset($edit)){{ route('edit_truck') }}@else{{ route('add_truck') }}@endif">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('registration_no') ? ' has-error' : '' }}">
                                <label for="registration_no" class="col-md-4 control-label">Registration No</label>

                                <div class="col-md-6">
                                    <input id="registration_no" type="text" class="form-control" name="registration_no" value="@if(isset($edit)){{$truck->registration_no}}@else{{ old('registration_no') }}@endif" required autofocus>

                                    @if ($errors->has('registration_no'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('registration_no') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            @if(isset($edit))
                                <input type="hidden" value="{{$truck->id}}" name="id">
                            @endif

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Register
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
