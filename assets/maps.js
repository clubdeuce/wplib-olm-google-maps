var gmMaps = {};

function generate_map(mapId, mapParams, mapMarkers, infoWindows) {
    var map = new google.maps.Map(document.getElementById(mapId), {
        center: mapParams.center,
        zoom: Number(mapParams.zoom)
    });
    var markers = [];
    var windows = [];

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

    gmMaps[mapId] = {map: map, markers: markers, infoWindows: windows};
}