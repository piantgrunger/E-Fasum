<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LokasiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lokasi-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_lokasi') ?>

    <?= $form->field($model, 'id_propinsi') ?>

    <?= $form->field($model, 'id_kota') ?>

    <?= $form->field($model, 'id_kecamatan') ?>

    <?= $form->field($model, 'id_kelurahan') ?>

    <?php // echo $form->field($model, 'no_sertifikat') ?>

    <?php // echo $form->field($model, 'luas_tanah') ?>

    <?php // echo $form->field($model, 'nib') ?>

    <?php // echo $form->field($model, 'nama_sertifikat') ?>

    <?php // echo $form->field($model, 'tanggal_sertifikat') ?>

    <?php // echo $form->field($model, 'hak') ?>

    <?php // echo $form->field($model, 'alamat_lokasi') ?>

    <?php // echo $form->field($model, 'nama_perumahan') ?>

    <?php // echo $form->field($model, 'alamat_perumahan') ?>

    <?php // echo $form->field($model, 'nilai_satuan') ?>

    <?php // echo $form->field($model, 'total_nilai') ?>

    <?php // echo $form->field($model, 'asal_usul') ?>

    <?php // echo $form->field($model, 'pencatatan') ?>

    <?php // echo $form->field($model, 'latitude') ?>

    <?php // echo $form->field($model, 'longitude') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
