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
'&zoom=13&size=800x600&maptype=roadmap&markers=color:blue%7Clabel:Lokasi%7C'.$model->latitude.','.$model->longitude.'&key='.$key), ['width' => '100%','height'=>'300px']); ?>

</div>

<div class="col-md-6">
    <h1><?= Html::encode($this->title); ?></h1>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'register',
            'kode_barang',
            'nama_barang',
            'dokumen_kepemilikan',
            'hak',
            'no_sertifikat',
            'luas_tanah',
            'nama_sertifikat',
            'alamat_lokasi',
            'latitude',
           'longitude',
            'nilai_satuan',

        ],
    ]); ?>
</div>
</div>
<footer class="footer">
    <div class="container">
        <p class="pull-right" align ="center">  Banjarbaru  <?= date('d F Y'); ?> <br>
       Sekretaris Daerah <br>
        Selaku Pengelola Barang,<br>
        &nbsp;<br>
        &nbsp;<br>
        &nbsp;<br>
        &nbsp;<br>
        &nbsp;<br>
   <b><u>  Drs. H. SAID ABDULLAH, M.Si
   </u></b>   <br>
Pembina  Utama Madya<br>
NIP. 19650928 199203 1 008

        </p>

    </div>
</footer>