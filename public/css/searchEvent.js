 $('eventSearchForm').submit(function(event) {
 event.preventDefault();
 });


$(document).ready(function ()
{
        $("input[type=radio][name=radius]").change(function ()
        {
                executeAjax();
        });
});

function initAutocomplete() {
        var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 42.9956, lng: -71.4548},
                zoom: 13, mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        var infoWindow = new google.maps.InfoWindow({map: map});

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                        var pos = {
                                lat: position.coords.latitude,
                                lng: position.coords.longitude
                        };

                        infoWindow.setPosition(pos);
                        infoWindow.setContent('Location found.');
                        map.setCenter(pos);
                }, function () {
                        handleLocationError(true, infoWindow, map.getCenter());
                });
        } else {
                // Browser doesn't support Geolocation
                handleLocationError(false, infoWindow, map.getCenter());
        }

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function () {
                searchBox.setBounds(map.getBounds());
        });

        var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function () {
                var places = searchBox.getPlaces();

                if (places.length == 0) {
                        return;
                }

                // Clear out the old markers.
                markers.forEach(function (marker) {
                        marker.setMap(null);
                });
                markers = [];

                // For each place, get the icon, name and location.
                var bounds = new google.maps.LatLngBounds();
                places.forEach(function (place) {
                        document.getElementById('gm_lat').value = (place.geometry.location.lat());
                        document.getElementById('gm_lng').value = (place.geometry.location.lng());
                        var icon = {
                                url: place.icon,
                                size: new google.maps.Size(71, 71),
                                origin: new google.maps.Point(0, 0),
                                anchor: new google.maps.Point(17, 34),
                                scaledSize: new google.maps.Size(25, 25)
                        };

                        // Create a marker for each place.
                        markers.push(new google.maps.Marker({
                                map: map,
                                icon: icon,
                                title: place.name,
                                position: place.geometry.location
                        }));

                        if (place.geometry.viewport) {
                                // Only geocodes have viewport.
                                bounds.union(place.geometry.viewport);
                        } else {
                                bounds.extend(place.geometry.location);
                        }
                });
                map.fitBounds(bounds);
                executeAjax();
        });
}

function executeAjax() {
    // Set up the ajax call; see http://api.jquery.com/jquery.ajax for more details
    $.ajax({
        url: '/events/search', // Route that will handle the request; its job is to return us books.
        method: 'POST',
        dataType : 'html', // Kind of data we're expecting to get back
        data: { // Two pieces of data we'll send with the request
            '_token': $('input[name=_token]').val(),
            'gm_lat': $('#gm_lat').val(),
            'gm_lng': $('#gm_lng').val(),
            'radius': $("input[type=radio][name=radius]:checked").val()
        },
        // What to do before each ajax
        beforeSend: function() {
            // $('#loading').show();
            $('#results').removeClass('error');
        },
        // What to do upon completion of a successful ajax call
        success: function(data) {
            // $('#loading').hide();
            $('#results').html(data);
        },
        // What to do upon completion of an unsuccessful ajax call
        error: function() {
            $('#results').html('Sorry, there was an error; your request could not be completed.');
            $('#results').addClass('error');
        }

    });
}

function convertPlaceResultToJSON(placeResult) {
        var json = "{\"placeResult\" : { " +
                "\"place_id\" : \"" + placeResult.place_id + "\"," +
                "\"name\" : \"" + placeResult.name + "\"," +
                "\"formatted_address\" : \"" + placeResult.formatted_address + "\"," +
                "\"geometry\" : { " +
                "\"location\" : { " +
                "\"lat\" :" + placeResult.geometry.location.lat() + "," +
                "\"lng\" :" + placeResult.geometry.location.lng() +
                "} } } }";
        return json;
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                'Error: The Geolocation service failed.' :
                'Error: Your browser doesn\'t support geolocation.');
}


