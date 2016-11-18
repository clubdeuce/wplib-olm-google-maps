jQuery(document).ready(function($){
    var map = new google.maps.Map(document.getElementById('map'), {
        center: objMapParams.center,
        zoom: Number(objMapParams.zoom)
    });

    $.each(objMapMarkers, function(key, marker) {
        marker.map = map;
        new google.maps.Marker(marker);
    });
});