<?php

use dosamigos\google\maps\Map;
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Event;

if ($key >=0) {
    $marker_dragend_event_js = <<<JS
    document.getElementById("detlokasi-$key-latitude").value = event.latLng.lat();
    document.getElementById("detlokasi-$key-longitude").value = event.latLng.lng();
JS;
} else {
    $marker_dragend_event_js = <<<JS
    document.getElementById("lokasi-latitude").value = event.latLng.lat();
    document.getElementById("lokasi-longitude").value = event.latLng.lng();
JS;
}


    $coord = new LatLng(['lat' => -3.456401, 'lng' => 114.808827]);

$map = new Map([
    'center' => $coord,
    'zoom' => 14,
    'width' => '100%',
]);
$marker = new Marker([
    'position' => $coord,
    'name' => 'marker_fasum',
    'title' => 'Fasum',
    'animation' => 'google.maps.Animation.DROP',
    'draggable' => true,
    'visible' => 'true',
    'events' => [
        new Event([
             'trigger' => 'dragend',
             'js' => $marker_dragend_event_js,
        ]),
     ],
]);
$map->addOverlay($marker);
// Display the map -finally :)
echo $map->display();
