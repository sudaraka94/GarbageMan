@extends('layouts.app')

    @section('styles')
        <meta name="viewport" content="initial-scale=1.0">
        <style>
            /* Always set the map height explicitly to define the size of the div
             * element that contains the map. */
            #map {
                height: 70%;
            }
            /* Optional: Makes the sample page fill the window. */
        </style>
    @endsection
    @section('content')
        @if ($errors->has('lng_in'))
            <div class="alert alert-danger alert-dismissable">
                <strong>Error</strong> Please Select a Valid Position From Map
            </div>
        @endif
        <div class="container">
            <h2>Add a client</h2>
            <form class="form-horizontal" action="@if (isset($edit)){{route('edit_collection_point')}} @else {{route('add_client')}} @endif" method="post">
                {{csrf_field()}}
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">User E-Mail Address</label>
                <div class="col-md-8">
                    <input list="emails" id="email" type="email" class="form-control" name="email" value="@if(isset($edit)){{$client->user->email}}@else{{ old('email') }}@endif"  required>
                    <datalist id="emails">
                        @foreach($users as $user)
                            <option value="{{$user->email}}">
                        @endforeach
                    </datalist>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
                <div class="form-group{{ $errors->has('area') ? ' has-error' : '' }}">
                    <label for="area" class="col-md-4 control-label">Area</label>
                    <div class="col-md-8">
                        <select list="area"  id="area"  class="form-control" name="area">
                            @foreach($areas as $area)
                                <option value="{{$area->id}}" @if(isset($edit))@if($client->area->id==$area->id) selected @endif @endif>{{$area->name}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('area'))
                            <span class="help-block">
                                <strong>{{ $errors->first('area') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
    @if(isset($edit))
                    <input type="hidden" name="id" value="{{$client->id}}">
    @endif
                <div class="form-group{{ $errors->has('map') ? ' has-error' : '' }}" >
                    <label for="map" class="col-md-4 control-label">User Collection Point <br> <br><small>Longitude : <div id="lg"></div> </small><br> <small>Latitude : <div id="lat"></div> </small></label>
                    <div class="container" >
                        <div id="map" height="10px" width="100%" class="col-md-8" style=""></div>
                    </div>
                    <input type="hidden" id="lng_in" name="lng_in" value="@if(isset($edit)){{$client->lng_in}}@else{{ old('lng_in') }}@endif">
                    <input type="hidden" id="lat_in" name="lat_in" value="@if(isset($edit)){{$client->lat_in}}@else{{ old('lat_in') }}@endif">
                </div>

            <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                <label for="comment" class="col-md-4 control-label">User Address</label>
                <div class="col-md-8">

                    <textarea class="form-control" rows="5"  name="address" id="address">@if(isset($edit)){{$client->address}}@else{{ old('address') }}@endif</textarea>
                    @if ($errors->has('address'))
                        <span class="help-block">
                            <strong>{{ $errors->first('address') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <button style="float: right;margin-top: 4%;margin-bottom: 4%" type="submit" class="btn btn-default">Submit</button>
            </div>
            </form>
        </div>
        <script>
//            variables needed
            var map;
            var marker;
            var infowindow;
            var messagewindow;

            function initMap() {
                map = new google.maps.Map(document.getElementById('map'), {
                    @if(isset($edit))
                        center: {lat: {{$client->lat_in}}, lng: {{$client->lng_in}}},
                    @else
                        center: {lat: {{$ccouncil->lat_in}}, lng: {{$council->lng_in}}},
                    @endif
                    zoom: 16
                });
                @if(isset($edit))
                    marker = new google.maps.Marker({
                        position: {lat: {{$client->lat_in}}, lng: {{$client->lng_in}}},
                        map: map
                    });
                var ln_div = document.getElementById('lg');
                var lat_div = document.getElementById('lat');
                var lat_in = document.getElementById('lat_in');
                var lng_in = document.getElementById('lng_in');

                ln_div.innerHTML = marker.getPosition().lng();
                lat_div.innerHTML =marker.getPosition().lat();
                lng_in.value=marker.getPosition().lng();
                lat_in.value=marker.getPosition().lat();
                @endif
                infowindow = new google.maps.InfoWindow({
                    content: document.getElementById('form')
                })

                messagewindow = new google.maps.InfoWindow({
                    content: document.getElementById('message')
                });

                google.maps.event.addListener(map, 'click', function(event) {
                    if(marker!=null){
                        marker.setMap(null);
                    }
                    marker = new google.maps.Marker({
                        position: event.latLng,
                        map: map
                    });
                    var ln_div = document.getElementById('lg');
                    var lat_div = document.getElementById('lat');
                    var lat_in = document.getElementById('lat_in');
                    var lng_in = document.getElementById('lng_in');

                    ln_div.innerHTML = marker.getPosition().lng();
                    lat_div.innerHTML =marker.getPosition().lat();
                    lng_in.value=marker.getPosition().lng();
                    lat_in.value=marker.getPosition().lat();
                    });


                function deleteMarkers() {
                    setMapOnAll(null);
                }

            }
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCqF73CTT_cb9hE0EhO6_70b_loiIgc8iw&callback=initMap"
                async defer></script>
    @endsection
    <html>
