<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use kartik\widgets\DepDrop;
use yii\helpers\Url;
use kartik\datecontrol\DateControl;
use yii\bootstrap\Tabs;
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
        <?= $form->errorSummary($model) ?> <!-- ADDED HERE -->
<?php
    $item =
[
    [
        'label' => 'Data Lokasi',
        'content' => $this->render('_form_lokasi', ['model' => $model, 'form' => $form]),
        'active' =>true,
    ],
    [
        'label' => 'Data Sertifikat',
        'content' => $this->render('_form_sertifikat', ['model' => $model, 'form' => $form]),

    ],
        [
        'label' => 'Data Keterangan',
        'content' => $this->render('_form_keterangan', ['model' => $model, 'form' => $form]),

    ],



];

    echo Tabs::widget([
        'items' =>$item]);

?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
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
