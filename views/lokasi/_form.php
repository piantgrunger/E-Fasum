<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Event;

$marker_dragend_event_js = <<<JS
    document.getElementById('lokasi-latitude').value = event.latLng.lat();
    document.getElementById('lokasi-longitude').value = event.latLng.lng();
JS;

/* @var $this yii\web\View */
/* @var $model app\models\Lokasi */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="lokasi-form">
<div class="col-md-6">
    <?php $form = ActiveForm::begin(); ?>
        <?= $form->errorSummary($model); ?> <!-- ADDED HERE -->

    <?= $form->field($model, 'nama_lokasi')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'alamat_lokasi')->textInput(['maxlength' => true]); ?>


    <?= $form->field($model, 'latitude')->textInput(); ?>

    <?= $form->field($model, 'longitude')->textInput(); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']); ?>
    </div>
    </div><div class="col-md-6">
    <?php
if (!is_null($model->latitude)) {
    $coord = new LatLng(['lat' => $model->latitude, 'lng' => $model->longitude]);
} else {
    $coord = new LatLng(['lat' => -3.456401, 'lng' => 114.808827]);
}
$map = new Map([
    'center' => $coord,
    'zoom' => 14,
    'width' => '100%',
]);
$marker = new Marker([
    'position' => $coord,
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
?>    
    </div>

    <?php ActiveForm::end(); ?>

</div>
