<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use kartik\widgets\DepDrop;
use yii\helpers\Url;


?>
<?=  Html::activeHiddenInput($model, 'id_propinsi')?>

<?= Html::activeHiddenInput($model, 'id_kota') ?>

   <?= $form->field($model, 'id_kecamatan')->widget(DepDrop::classname(), [
'type'=>DepDrop::TYPE_SELECT2,
'data'=> [$model->id_kecamatan=>is_null($model->kecamatan)?"":$model->kecamatan->nama_kecamatan],
'options'=>[ 'placeholder'=>'Pilih Kecamatan ...'],
'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
'pluginOptions'=>[
    'depends'=>['lokasi-id_kota'],
    'url'=>Url::to(['/lokasi/kecamatan']),
    'placeholder'=>'Pilih Kecamatan ...',
    'initialize' =>true,

    ]
])->label('Kecamatan'); ?>


     <?= $form->field($model, 'id_kelurahan')->widget(DepDrop::classname(), [
'type'=>DepDrop::TYPE_SELECT2,
'data'=> [$model->id_kelurahan=>is_null($model->kelurahan)?"":$model->kelurahan->nama_kelurahan],
'options'=>[ 'placeholder'=>'Pilih kelurahan ...'],
'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
'pluginOptions'=>[
    'depends'=>['lokasi-id_kecamatan'],
    'url'=>Url::to(['/lokasi/kelurahan']),
    'placeholder'=>'Pilih kelurahan ...',
    'initialize' =>true,

    ]
])->label('Kelurahan'); ?>
    <?= $form->field($model, 'alamat_lokasi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama_perumahan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alamat_perumahan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'latitude')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'longitude')->textInput(['maxlength' => true]) ?>
