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
<div class="header" style="margin-bottom :40px">
<div class="image" style="background: url('<?=Url::to(['/logo.png'])?>') no-repeat;background-size:cover;  width: 56px; height: 75px; float: left;
    display: inline-block;"></div>
<div class="text" style="float: left;
    display: inline-block;
    vertical-align: bottom;"><h3><p     align='center'><b>LAPORAN DATA TANAH PER PERSIL TANAH <br>
MILIK PEMERINTAH KOTA BANJARBARU </b></p></h3>
</div>
</div>

<div class="img-responsive" style="margin-top:20px;margin-bottom:20px">
<?=Html::img(Url::to('https://maps.googleapis.com/maps/api/staticmap?center='.$model->latitude.','.$model->longitude.
'&zoom=13&size=800x600&maptype=roadmap&markers=color:red%7Clabel:Lokasi%7C'.$model->latitude.','.$model->longitude.'&key='.$key), ['width' => '100%','height'=>'250px']); ?>
</div>
</div>

<div class="col-md-6"style="margin-top:20px;" >

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
           'titik_koordinat',
           'utara',
            'selatan',
            'timur',
            'barat',

           'penggunaan_tanah',
            'nilai_satuan',

        ],
    ]); ?>
</div>
</div>
<footer class="footer">
    <div class="container" style>
        <p class="pull-right" align ="right" style="float:right">  Banjarbaru  <?= date('d F Y'); ?> <br>
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