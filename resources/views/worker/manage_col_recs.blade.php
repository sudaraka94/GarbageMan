@extends('layouts.app')
@section('content')
    <div class="container">
        <div style="text-align: center">
            <h1>Manage Garbage Collection Records</h1>
        </div>
        <a href="{{route('add_col_rec')}}" type="button" class="btn btn-info">Add Collection Record</a>
        <br><br>
        <table class="table" width="100%">
            <tr>
                <th width="20%">Truck</th>
                <th width="20%">Collection Point</th>
                <th width="10%"></th>
                <th width="10%"></th>
            </tr>
            @foreach($col_recs as $col_rec)
                <tr>
                    <td>{{$col_rec->truck->registration_no}}</td>
                    <td>{{$col_rec->client->address}}</td>
                    <td>
                        {{--<form action="{{route('edit_col_rec')}}" method="get">--}}
                            {{--{{csrf_field()}}--}}
                            {{--<input type="hidden" value="{{$col_rec->id}}" name="id">--}}
                            {{--<input type="submit" value="Edit" class="btn btn-success">--}}
                        {{--</form>--}}
                    </td>
                    <td>
                        <form action="{{route('delete_col_rec')}}">
                            {{csrf_field()}}
                            <input type="hidden" value="{{$col_rec->id}}" name="id">
                            <input type="submit" value="Delete" class="btn btn-danger">
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection