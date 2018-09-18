<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

$key = Yii::$app->params['googleMapKey'];

/* @var $this yii\web\View */
/* @var $model app\models\Lokasi */

$this->title = $model->no_brankas;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar Lokasi'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lokasi-view">
<div class="col-md-6">

<?=Html::img(Url::to('https://maps.googleapis.com/maps/api/staticmap?center='.$model->latitude.','.$model->longitude.
'&zoom=13&size=800x600&maptype=roadmap&markers=color:blue%7Clabel:Lokasi%7C'.$model->latitude.','.$model->longitude.'&key='.$key), ['width' => '100%']); ?>

</div>

<div class="col-md-6">
    <h1><?= Html::encode($this->title); ?></h1>

    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
          //  'id_propinsi',
          //  'id_kota',
          'no_brankas',
            'nama_kecamatan',
           'nama_kelurahan',
            'no_sertifikat',
            'luas_tanah',
            'nama_sertifikat',
            'tanggal_sertifikat',
            'hak',
            'nama_kecamatan',
            'nama_kelurahan',
            'alamat_lokasi',
            'nilai_satuan',
            'total_nilai',
        ],
    ]); ?>
</div>
</div>
