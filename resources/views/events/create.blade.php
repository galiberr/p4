<!DOCTYPE html>
<html>
        <head>
                <title>Places Searchbox</title>
                <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
                <meta charset="utf-8">
                <link href='/css/googleMaps.css' rel='stylesheet'>
        </head>
        <body>
                <input id="pac-input" class="controls" type="text" placeholder="Search Box">
                <div id="map"></div>
                
                <form name="createUserForm" id="createUserForm" method="POST" action="/events/create">
                {{ csrf_field() }}
                <input id="placeID" name="placeID" type="text" placeholder="Place ID" value="{{ old('placeID') }}"><br />
                <input id="placeName" name="placeName" type="text" placeholder="Place name" value="{{ old('placeName') }}"><br />
                <input id="placeAddr" name="placeAddr" type="text" placeholder="Place address" value="{{ old('placeAddr') }}"><br />
                <input id="latitude" name="latitude" type="text" placeholder="Place latitude" value="{{ old('latitude') }}"><br />
                <input id="longitude" name="longitude" type="text" placeholder="Place longitude" value="{{ old('longitude') }}">
                        <input type="hidden" name="placeResult" id="placeResult" value="" />
                <button type="submit">Submit</button>
                Place ID = {{ $test['placeResult']['place_id'] }} <br />
                Place name = {{ $test['placeResult']['name'] }} <br />
                Place address = {{ $test['placeResult']['formatted_address'] }} <br />
                Place latitude = {{ $test['placeResult']['geometry']['location']['lat'] }} <br />
                Place longitude = {{ $test['placeResult']['geometry']['location']['lng'] }} <br />
                <script src="/css/googleMaps.js"></script>
                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0dqL134UviB9iw-Eqaj2aKjUCBLCsezM&libraries=places&callback=initAutocomplete"
                async defer></script>
        </body>
</html>