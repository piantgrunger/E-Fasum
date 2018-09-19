<?php

use yii\helpers\Html;
use kartik\widgets\DepDrop;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\models\Barang;
use kartik\select2\Select2;
use kartik\datecontrol\DateControl;

$js = "$('#modalButton').click(function (){
    console.log('Hyy');
    $('#modal').modal('show')
        .find('#modalContent')
        .load($(this).attr('value'));
});";
$this->registerJS($js);


$data = ArrayHelper::map(
    Barang::find()
        ->select([
            'id_barang', 'ket' => " concat(kode_barang,' - ',nama_barang)",
        ])
        ->asArray()
        ->all(),
    'id_barang',
    'ket'
);

$js = <<<JS
  $(document).ready(function()
    {
  if ($("#lokasi-id_barang") . val() === "7") {
    document.getElementById("perumahan").style.display="block";
} else {
    document.getElementById("perumahan").style.display="none";
}

  if ($("#lokasi-dokumen_kepemilikan") . val() !== "Tanpa Dokumen") {
    document.getElementById("sertifikat").style.display="block";
} else {
    document.getElementById("sertifikat").style.display="none";
}


    });

    $("#lokasi-dokumen_kepemilikan") . on("change", function (e)
    {

  if ($("#lokasi-dokumen_kepemilikan") . val() !== "Tanpa Dokumen") {
    document.getElementById("sertifikat").style.display="block";
} else {
    document.getElementById("sertifikat").style.display="none";
}
});
    $("#lokasi-id_barang") . on("change", function (e)
    {
  if ($("#lokasi-id_barang") . val() === "7") {
    document.getElementById("perumahan").style.display="block";
} else {
    document.getElementById("perumahan").style.display="none";
}
    });

    $("#lokasi-luas_tanah") . on("change", function (e)
    {

        $("#luas_tanah2").text($(this).val());
       var total =parseFloat($(this).val())*parseFloat($("#lokasi-nilai_satuan").val());
       $("#lokasi-total_nilai").val(total);

    });


    $("#lokasi-nilai_satuan") . on("change", function (e)
    {


       var total =parseFloat($(this).val())*parseFloat($("#lokasi-luas_tanah").val());
       $("#lokasi-total_nilai").val(total);

    });

JS;
$this->registerJS($js);

?>
<?=$form->field($model, 'id_barang')->widget(Select2::className(), [
    'data' => $data,
    'options' => ['placeholder' => 'Pilih Barang...',
    ],
    'pluginOptions' => [
        'allowClear' => true,
    ],
])->label('Nama Barang');
?>
<div id="perumahan">
<?= $form->field($model, 'nama_perumahan')->textInput(['maxlength' => true]); ?>
</div>
<?= $form->field($model, 'dokumen_kepemilikan')->dropDownList(
    ['Tanpa Dokumen' => 'Tanpa Dokumen',
    'Sertifikat' => 'Sertifikat',
    'Sporadik' => 'Sporadik',
    'Surat Keterangan (SKT)' => 'Surat Keterangan (SKT)',
    'Segel' => 'Segel',
],
    ['prompt' => '']
);
?>
<div id="sertifikat">
 <?= $form->field($model, 'no_sertifikat')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'nama_sertifikat')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'tanggal_sertifikat')->widget(DateControl::className()); ?>

</div>
<?= $form->field($model, 'asal_usul')->dropDownList(
    [
        'Pembelian' => 'Pembelian',
        'Hibah' => 'Hibah',
        'Historis' => 'Historis',
    ],
    ['prompt' => '']
);
?>
<?= $form->field($model, 'hak')->dropDownList(
    [
        'HPL' => 'HPL',
        'HP' => 'HP',
        'HM' => 'HM',
        'HGB' => 'HGM',
    ],
    ['prompt' => '']
);
?>

  <?= $form->field($model, 'luas_tanah')->textInput(['maxlength' => true]); ?>
<div class="text-bold">Lokasi Aset</div>
<div class="text">&nbsp</div>

<?= Html::activeHiddenInput($model, 'id_propinsi'); ?>

<?= Html::activeHiddenInput($model, 'id_kota'); ?>

   <?= $form->field($model, 'id_kecamatan')->widget(DepDrop::classname(), [
        'type' => DepDrop::TYPE_SELECT2,
        'data' => [$model->id_kecamatan => is_null($model->kecamatan) ? '' : $model->kecamatan->nama_kecamatan],
        'options' => ['placeholder' => 'Pilih Kecamatan ...'],
        'select2Options' => ['pluginOptions' => ['allowClear' => true]],
        'pluginOptions' => [
            'depends' => ['lokasi-id_kota'],
            'url' => Url::to(['/lokasi/kecamatan']),
            'placeholder' => 'Pilih Kecamatan ...',
            'initialize' => true,
        ],
    ])->label('Kecamatan'); ?>


     <?= $form->field($model, 'id_kelurahan')->widget(DepDrop::classname(), [
        'type' => DepDrop::TYPE_SELECT2,
        'data' => [$model->id_kelurahan => is_null($model->kelurahan) ? '' : $model->kelurahan->nama_kelurahan],
        'options' => ['placeholder' => 'Pilih kelurahan ...'],
        'select2Options' => ['pluginOptions' => ['allowClear' => true]],
        'pluginOptions' => [
            'depends' => ['lokasi-id_kecamatan'],
            'url' => Url::to(['/lokasi/kelurahan']),
            'placeholder' => 'Pilih kelurahan ...',
            'initialize' => true,
        ],
    ])->label('Kelurahan'); ?>
    <?= $form->field($model, 'alamat_lokasi')->textInput(['maxlength' => true]); ?>

<div class="panel panel-primary"   >
<div class="panel-heading"> Titik Koordinat Lokasi

</div>
</div>
<table class="table">
    <thead>
        <tr>
        <th> Posisi </th>

             <th>X</th>
            <th>Y</th>
            <th>Peta </th>


        </tr>
    </thead>
    <?= \mdm\widgets\TabularInput::widget([
        'id' => 'detail-grid2',
        'allModels' => $model->detailLokasi,
        'model' => \app\models\Detlokasi::className(),
        'tag' => 'tbody',
        'form' => $form,
        'itemOptions' => ['tag' => 'tr'],
        'itemView' => '_item_lokasi',
        'clientOptions' => [
            'btnAddSelector' => '#btn-add2',
        ],
    ]);
    ?>
    </table>


    <?= $form->field($model, 'longitude')->textInput(['maxlength' => true]); ?>

 <?= $form->field($model, 'latitude')->textInput(['maxlength' => true]); ?>

<?= Html::button('Peta Lokasi', ['value' => Url::to(['/lokasi/peta', 'key' => -1]), 'class' => 'btn btn-success', 'id' => 'modalButton']); ?>

 <?= $form->field($model, 'penggunaan_tanah')->textArea(); ?>
