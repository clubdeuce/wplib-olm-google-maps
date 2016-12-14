jQuery(document).ready(function($){
    var map = new google.maps.Map(document.getElementById('map'), {
        center: objMapParams.center,
        zoom: Number(objMapParams.zoom)
    });
    var markers = [];

    var infoWindow = new google.maps.InfoWindow({
        content: 'This is some content'
    });

    $.each(objMapMarkers, function(key, object) {
        object.map = map;
        markers.push(new google.maps.Marker(object));
    });

    $.each(markers, function(key, marker) {
        marker.addListener('click', function(){
            infoWindow.setContent(objInfoWindows[key].content);
            infoWindow.open(map, marker);
        });
    });
});