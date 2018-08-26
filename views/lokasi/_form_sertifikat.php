<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datecontrol\DateControl;

?>
    <?= $form->field($model, 'no_sertifikat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'luas_tanah')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nib')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama_sertifikat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tanggal_sertifikat')->widget(DateControl::className()) ?>

    <?= $form->field($model, 'hak')->textInput(['maxlength' => true]) ?>
