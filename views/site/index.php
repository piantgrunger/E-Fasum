<?php

use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\overlays\InfoWindow;
use yii\helpers\Url;

/* @var $this yii\web\View */

?>
<div class="site-index">



<?php

$coord = new LatLng(['lat' => -3.456401, 'lng' => 114.808827]);
$map = new Map([
    'center' => $coord,
    'zoom' => 14,
    'width' => '100%',
]);
foreach ($modelLokasi as $lokasi) {
    $coordLokasi = new LatLng(['lat' => $lokasi->latitude, 'lng' => $lokasi->longitude]);

    $marker = new Marker([
        'position' => $coordLokasi,
        'title' => $lokasi->nama_perumahan,
        'animation' => 'google.maps.Animation.DROP',
        'draggable' => false,
        'visible' => 'true',
    ]);
    $marker->attachInfoWindow(
        new InfoWindow([
            'content' => '<a href='.Url::to(['/lokasi/view', 'id' => $lokasi->id_lokasi]).' >Detail Fasum</a>',
       ]));

    $map->addOverlay($marker);
    // code...
}
// Display the map -finally :)
echo $map->display();
?>




</div>
