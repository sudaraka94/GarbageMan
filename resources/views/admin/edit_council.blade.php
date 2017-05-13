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
        <h2>Change Council Location</h2>
        <form action="{{route('edit_council_pos')}}" method="post">
            <input type="hidden" name="id" id="id" value="{{$council->id}}">
            {{csrf_field()}}
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 control-label">Council Name</label>
                <div class="col-md-8">
                    <input id="name" type="text" class="form-control" name="name" value="@if(isset($council)){{$council->name}}@else{{ old('name') }}@endif"  required>

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('map') ? ' has-error' : '' }}" >
                <label for="map" class="col-md-4 control-label">Location <br> <br><small>Longitude : <div id="lg"></div> </small><br> <small>Latitude : <div id="lat"></div> </small></label>
                <div class="container" >
                    <div id="map" height="10px" width="100%" class="col-md-8" style="padding-right: 45px;margin-right: 10px;margin-top: 10px"></div>
                </div>
                <input type="hidden" id="lng_in" name="lng_in" value="{{$council->lng_in}}">
                <input type="hidden" id="lat_in" name="lat_in" value="{{$council->lat_in}}">
            </div>

            <div class="form-group">
                <button style="float: right;margin-top: 4%;margin-bottom: 4%" type="submit" class="btn btn-default">Submit</button>
            </div>
        </form>
        <div style="height: 10%"></div>
    </div>
    <script>
        //            variables needed
        var map;
        var marker;
        var infowindow;
        var messagewindow;

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: {{$council->lat_in}}, lng: {{$council->lng_in}}},
                zoom: 16
            });
            marker = new google.maps.Marker({
                position: {lat: {{$council->lat_in}}, lng: {{$council->lng_in}}},
                map: map

            });
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
