var gmMaps = {};

function generate_map(mapId, mapParams, mapMarkers, infoWindows) {
    var map = new google.maps.Map(document.getElementById(mapId), {
        center: mapParams.center,
        zoom: Number(mapParams.zoom)
    });
    markers = [];

    infoWindow = new google.maps.InfoWindow({});

    jQuery.each(mapMarkers, function(key, object) {
        object.map = map;
        markers.push(new google.maps.Marker(object));
    });

    jQuery.each(markers, function(key, marker) {
        marker.addListener('click', function(){
            infoWindow.setContent(infoWindows[key].content);
            infoWindow.open(map, marker);
        });

    });

    gmMaps[mapId] = {map: map, markers: markers, infoWindow: infoWindow};
}