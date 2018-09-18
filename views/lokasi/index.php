<?php


use hscstudio\mimin\components\Mimin;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;

$gridColumns = [
    ['class' => 'kartik\grid\SerialColumn'],
    ['class' => 'kartik\grid\ActionColumn', 'template' => Mimin::filterActionColumn([
        'update', 'delete', 'view'
    ], $this->context->route)." {print}",
        'buttons' => [
            'print' => function ($url, $model) {
                if (Mimin::checkRoute($this->context->id . '/print')) {
                    return
                        Html::a(
                        '<span class="glyphicon glyphicon-print"></span>',
                        ['print', 'id' => $model->id_lokasi],
                        [
                            'title' => Yii::t('app', 'Print'),
                            'data-pjax' => 0
                        ]
                    );
                } else {
                    return ' ';
                }
            }
        ]


],
          //  'id_propinsi',
          //  'id_kota',
    'nama_barang',
    'kode_barang',
    'register',
    'hak',
    'no_sertifikat',
    'luas_tanah',
    'tanggal_sertifikat',
    'dokumen_kepemilikan',
    'nama_sertifikat',
    'alamat_lokasi',

    'nama_kecamatan',
    'nama_kelurahan',
    'nama_perumahan',
            // 'alamat_perumahan',
    'nilai_satuan',
    'total_nilai',
    'papan_nama',
    'patok',
    'pondasi',
    'pagar'

            // 'asal_usul',
            // 'pencatatan',
            // 'latitude',
            // 'longitude',
            // 'created_at',
            // 'updated_at',

];
/*
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
*/
/* @var $this yii\web\View */
/* @var $searchModel app\models\LokasiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Daftar Lokasi');
$this->params['breadcrumbs'][] = $this->title;
//echo ExportMenu::widget(['dataProvider' => $dataProvider, 'columns' => $gridColumns]);
?>
<div class="lokasi-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]);?>

 <?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => $gridColumns,
    'tableOptions' => ['class' => 'table  table-bordered table-hover'],
    'striped' => false,
    'containerOptions' => [true],
    'pjax' => true,
    'bordered' => true,
    'striped' => false,
    'condensed' => false,
    'responsive' => true,
    'hover' => true,
    'showPageSummary' => true,
    'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<i class="glyphicon glyphicon-tasks"></i>  <strong> ' . Yii::t('app', 'Lokasi') . '</strong>',
      //  'before' => $this->render('_search', ['model' => $searchModel]),
    ],
    'toolbar' => [
        ['content' => ((Mimin::checkRoute($this->context->id . '/create'))) ? Html::a(Yii::t('app', 'Lokasi Baru'), ['create'], ['class' => 'btn btn-success']) : ''],
     Html::a(Yii::t(
         'app',
         'Laporan'
), ['report'], ['class' => 'btn btn-primary',  'data-pjax' => 0,]) ,
        '{export}',
        '{toggleData}',
    ],
    'exportConfig' => [GridView::CSV => ['filename' => $this->title], GridView::HTML => ['filename' => $this->title], GridView::PDF => ['filename' => $this->title], GridView::EXCEL => ['filename' => $this->title, 'options' => ['title' => $this->title]], GridView::TEXT => ['filename' => $this->title]], 'resizableColumns' => true,
]); ?>
    <?php Pjax::end(); ?>
</div>
