var gmMaps = {};
var geocoder = new google.maps.Geocoder;

jQuery(document).ready(function($){
   userLocation();
});


function generate_map(mapId, mapParams, mapMarkers, infoWindows) {
    var map = new google.maps.Map(document.getElementById(mapId), {
        center: mapParams.center,
        zoom: Number(mapParams.zoom)
    });
    var markers = [];

    jQuery.each(mapMarkers, function(key, object) {
        object.map = map;
        markers.push(new google.maps.Marker(object));
    });

    jQuery.each(markers, function(key, marker) {
        var infoWindow = new google.maps.InfoWindow({
            content: infoWindows[key].content
        });
        windows.push(infoWindow);
        marker.addListener('click', function(){
            infoWindow.open(map, marker);
        });
    });


    // Add the map, markers, and infoWindow objects to a global variable
    gmMaps[mapId] = {map: map, markers: markers, infoWindow: infoWindow};
}

// Get the browser location using HTML 5 Geolocation
function userLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            gmMaps["userLocation"] = {position: position};
            addressFromLocation(position.coords.latitude, position.coords.longitude);
        }, userLocationError);
    }
}

function userLocationError(error) {
    var errorMessage = '';
    
    switch(error.code) {
        case error.PERMISSION_DENIED:
            errorMessage = "User denied the request for Geolocation.";
            break;
        case error.POSITION_UNAVAILABLE:
            errorMessage = "Location information is unavailable.";
            break;
        case error.TIMEOUT:
            errorMessage = "The request to get user location timed out.";
            break;
        case error.UNKNOWN_ERROR:
            errorMessage = "An unknown error occurred.";
            break;
    }

    gmMaps['userLocation'] = {status: 'error', code: error.code, message: errorMessage};
}

/**
 *
 * @param lat
 * @param lng
 * @returns {*}
 */
function addressFromLocation(lat, lng) {
    var geocoder = new google.maps.Geocoder;
    var latLng   = new google.maps.LatLng(lat, lng);
    var address  = '';
    geocoder.geocode({'latLng': latLng}, function(results, status){
        if (status == google.maps.GeocoderStatus.OK){
            if(results[0]){
                gmMaps['userLocation']['address'] = results[0].formatted_address;
            }
        }
    });
}