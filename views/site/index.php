<?php

use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\overlays\InfoWindow;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;

$request = Yii::$app->request;
if (($request->isGet) &&(Yii::$app->user->isGuest)) {
    $js = "
$(window).on('load',function(){
    $('#myModal').modal('show');
});
";

    $this->registerJS($js);
}
/* @var $this yii\web\View */

?>


<?php
  if (Yii::$app->user->isGuest) {
      Modal::begin([
                'id' => 'myModal',
                'size' => 'modal-lg',
            ]);
      echo "<div id='modalContent'> <img src='".Url::to(['/splash.jpg'])."'  width='100%' height='500px'></div>";
      Modal::end();
  }
?>

 <?php $form = ActiveForm::begin(['method'=>'POST']); ?>

        <?= $form
            ->field($model, 'cari')
            ->label(false)
            ->textInput(['placeholder' => 'Untuk Pencarian Masukkan Alamat atau Nama Perumahan']); ?>



        <?php ActiveForm::end(); ?>





<?php

$coord = new LatLng(['lat' => $center[0], 'lng' => $center[1]]);
$map = new Map([
    'center' => $coord,
    'zoom' => 14,
    'width' => '100%',
]);
foreach ($modelLokasi as $lokasi) {
    $coordLokasi = new LatLng(['lat' => $lokasi->latitude, 'lng' => $lokasi->longitude]);

    $marker = new Marker([
        'position' => $coordLokasi,
        'title' => $lokasi->nama_barang,
        'animation' => 'google.maps.Animation.DROP',
        'draggable' => false,
        'visible' => 'true',
    ]);
    $marker->attachInfoWindow(
        new InfoWindow([
            'content' => '<a href='.Url::to(['/site/view', 'id' => $lokasi->id_lokasi]).'> Detail Lokasi</a><br>'.Html::img(Url::to(['/media\/'.$lokasi->gambar]), ['width' => '150px', 'height' => '150px']),
       ])
    );

    $map->addOverlay($marker);
}
// Display the map -finally :)
echo $map->display();
?>




</div>
