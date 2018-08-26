<?php


use hscstudio\mimin\components\Mimin;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;

$gridColumns=[['class' => 'yii\grid\SerialColumn'],
          //  'id_propinsi',
          //  'id_kota',
            'nama_kecamatan',
            'nama_kelurahan',
             'no_sertifikat',
             'luas_tanah',
            // 'nib',
             'nama_sertifikat',
            'tanggal_sertifikat:date',
            // 'hak',
             'alamat_lokasi',
            // 'nama_perumahan',
            // 'alamat_perumahan',
            // 'nilai_satuan',
            // 'total_nilai',
            // 'asal_usul',
            // 'pencatatan',
            // 'latitude',
            // 'longitude',
            // 'created_at',
            // 'updated_at',

         ['class' => 'yii\grid\ActionColumn',   'template' => Mimin::filterActionColumn([
              'update','delete','view'], $this->context->route),    ],    ]; echo ExportMenu::widget(['dataProvider' => $dataProvider,'columns' => $gridColumns]);

/* @var $this yii\web\View */
/* @var $searchModel app\models\LokasiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Daftar Lokasi');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lokasi-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]);?>

    <p> <?php if ((Mimin::checkRoute($this->context->id."/create"))) {
    ?>        <?=  Html::a(Yii::t('app', 'Lokasi Baru'), ['create'], ['class' => 'btn btn-success']) ?>
    <?php
} ?>    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,        'responsive'=>true,
        'hover'=>true,
         'resizableColumns'=>true,
    ]); ?>
    <?php Pjax::end(); ?>
</div>
