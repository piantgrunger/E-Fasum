<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Lokasi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lokasi-form">

    <?php $form = ActiveForm::begin(); ?>
        <?= $form->errorSummary($model); ?> <!-- ADDED HERE -->

    <?= $form->field($model, 'nama_lokasi')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'jenis_lokasi')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'status')->textInput(); ?>

    <?= $form->field($model, 'google_place_id')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'gps')->textInput(); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
