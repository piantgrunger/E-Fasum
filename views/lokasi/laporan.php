<?php


use hscstudio\mimin\components\Mimin;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;
use yii\helpers\Inflector;

$label=$model[0]->attributeLabels();
$gridColumns=[
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

/* @var $this yii\web\View */
/* @var $searchModel app\models\LokasiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$no=1;
$this->title = "DAFTAR TANAH MILIK PEMERINTAH KOTA BANJARBARU<br>SAMPAI DENGAN TAHUN ANGGARAN ".date('Y');
?>
<div class="lokasi-index">
<div class="container">
<p class="pull-right"  align="right">    <h4><?=$this->title ?></h4></p>
</div>
<table class='table table-condensed table-striped table-hover table-bordered'>
<thead>
<tr>
<th>No.</th>
<?php foreach ($gridColumns as $column) {
    if (array_key_exists($column, $label)) {
        echo '<th>'.$label[$column].'</th>';
    } else {
        echo '<th>' . Inflector::camel2words($column) . '</th>';
    }
} ?>
</tr>
</thead>
<tbody>

<?php
foreach ($model as $data) {
    echo "<tr>";
    echo  "<td>$no </td>";
    $no++;

    //die(print_r($data));
    foreach ($gridColumns as $column) {
        if (array_key_exists($column, $data->attributes)) {
            echo '<td>'.  $data->attributes[$column].'</td>';
        } else {
            echo "<td>".$data->__get($column)."</td>";
        }
    }
    echo "</tr>";
}
?>

</tbody>
</table>
 </div>

<footer class="footer">
    <div class="container">
        <p class="pull-right" align ="right">  Banjarbaru  <?= date('d F Y'); ?> <br>
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