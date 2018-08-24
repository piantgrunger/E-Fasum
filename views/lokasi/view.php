<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use hscstudio\mimin\components\Mimin;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\overlays\Marker;

/* @var $this yii\web\View */
/* @var $model app\models\Lokasi */

$this->title = $model->id_lokasi;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar Lokasi'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lokasi-view">

    <h1><?= Html::encode($this->title); ?></h1>

    <p>
             <?php if ((Mimin::checkRoute($this->context->id.'/update'))) {
    ?>        <?= Html::a(Yii::t('app', 'Ubah'), ['update', 'id' => $model->id_lokasi], ['class' => 'btn btn-primary']); ?>
        <?php
} if ((Mimin::checkRoute($this->context->id.'/delete'))) {
        ?>        <?= Html::a(Yii::t('app', 'Hapus'), ['delete', 'id' => $model->id_lokasi], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Apakah Anda yakin ingin menghapus item ini??'),
                'method' => 'post',
            ],
        ]); ?>
        <?php
    } ?>    </p>
        <div class="col-md-6">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nama_lokasi',
            'alamat_lokasi',

            'latitude',
            'longitude',
            'created_at',
            'updated_at',
        ],
    ]); ?>
       </div><div class="col-md-6">
    <?php

$coord = new LatLng(['lat' => $model->latitude, 'lng' => $model->longitude]);
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
]);

$map->addOverlay($marker);
// Display the map -finally :)
echo $map->display();
?>    
    </div>

</div>
