@extends('layouts.app')
@section('styles')
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
        #right-panel {
            font-family: 'Roboto','sans-serif';
            line-height: 30px;
            padding-left: 10px;
        }

        #right-panel select, #right-panel input {
            font-size: 15px;
        }

        #right-panel select {
            width: 100%;
        }

        #right-panel i {
            font-size: 12px;
        }
        #map {
            height: 100%;
            float: left;
            width: 70%;
            height: 100%;
        }
        #right-panel {
            margin: 10px;
            margin-top: 0px;
            border-width: 0px;
            width: 25%;
            height: 400px;
            float: right;
            text-align: right;
            padding-top: 0;
        }
        #directions-panel {
            width: 100%;
            margin-top: 0px;
            background-color: #FFEE77;
            padding: 10px;
            overflow: scroll;
            height: 520px;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        @if(count($clients)==0)
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Warning!</strong> No garbage collection points in the area
            </div>
        @endif
        <h2>Route for today</h2>
        <div id="map" style="height: 530px;"></div>
        <div id="right-panel">
            <div id="directions-panel"></div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        function initMap() {
            var directionsService = new google.maps.DirectionsService;
            var directionsDisplay = new google.maps.DirectionsRenderer;
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 6,
                center: {lat: {{$council->lat_in}}, lng: {{$council->lng_in}}}
            });
            directionsDisplay.setMap(map);
            calculateAndDisplayRoute(directionsService, directionsDisplay);
        }

        function calculateAndDisplayRoute(directionsService, directionsDisplay) {
            var waypts = [];
            @foreach($clients as $client)
                waypts.push({
                location: new google.maps.LatLng({lat: {{$client->lat_in}}, lng: {{$client->lng_in}} }),
                stopover: true
            });
                    @endforeach


            directionsService.route({
                origin: 'Piliyandala',
                destination: 'Piliyandala',
                waypoints: waypts,
                optimizeWaypoints: true,
                travelMode: 'DRIVING'
            }, function(response, status) {
                if (status === 'OK') {
                    directionsDisplay.setDirections(response);
                    var route = response.routes[0];
                    var summaryPanel = document.getElementById('directions-panel');
                    summaryPanel.innerHTML = '';
                    // For each route, display summary information.
                    for (var i = 0; i < route.legs.length; i++) {
                        var routeSegment = i + 1;
                        summaryPanel.innerHTML += '<b>Route Segment: ' + routeSegment +
                                '</b><br>';
                        summaryPanel.innerHTML += route.legs[i].start_address + ' to ';
                        summaryPanel.innerHTML += route.legs[i].end_address + '<br>';
                        summaryPanel.innerHTML += route.legs[i].distance.text + '<br><br>';
                    }
                } else {
                    window.alert('Directions request failed due to ' + status);
                }
            });
        }
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCqF73CTT_cb9hE0EhO6_70b_loiIgc8iw&callback=initMap">
    </script>
@endsection