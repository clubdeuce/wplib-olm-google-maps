jQuery(document).ready(function($){
    var map = new google.maps.Map(document.getElementById('map'), {
        center: objMapParams.center,
        zoom: Number(objMapParams.zoom)
    });
    var markers = [];

    $.each(objMapMarkers, function(key, marker) {
        markers.push(new google.maps.Marker({
            map: map,
            position: marker.position,
            title: marker.title
        }));
    });
});