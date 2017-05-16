@extends('layouts.app')
@section('styles')

@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Add a collection record</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="@if(isset($edit)){{ route('edit_col_rec') }}@else{{ route('add_col_rec') }}@endif">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('client_id') ? ' has-error' : '' }}">
                                <label for="client_id" class="col-md-4 control-label">Choose Collection Point</label>
                                <div class="col-md-6">
                                    <select  id="client_id" class="form-control" name="client_id" required autofocus>
                                        @foreach($clients as $client)
                                            <option value="{{$client->id}}" @if(isset($edit)) @if($col_rec->client_id==$client->id) selected @endif @endif>{{$client->address}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('client_id'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('client_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            @if(isset($edit))
                                <input type="hidden" value="{{$col_rec->id}}" name="id">
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
