<?php

use yii\helpers\Html;
use kartik\widgets\DepDrop;
use yii\helpers\Url;

$setMarker = $this->registerJS('
');

?>
<?=  Html::activeHiddenInput($model, 'id_propinsi'); ?>

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

    <?= $form->field($model, 'nama_perumahan')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'alamat_perumahan')->textInput(['maxlength' => true]); ?>


<div class="panel panel-primary"   >
<div class="panel-heading"> Peta Lokasi

</div>
</div>
<table class="table">
    <thead>
        <tr>
             <th> Latitude </th>
            <th>Longitude</th>
            <th>Peta </th>


            <th><a id="btn-add2" href="#"><span class="glyphicon glyphicon-plus"></span></a></th>
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
