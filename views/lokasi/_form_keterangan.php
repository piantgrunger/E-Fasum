<?php
use kartik\widgets\FileInput;
use yii\helpers\Url;

?>

    <?= $form->field($model, 'nilai_satuan')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'total_nilai')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'asal_usul')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'pencatatan')->textInput(['maxlength' => true]); ?>
    <?= $form->field($model, 'gambar')->widget(FileInput::classname(), [
    'options' => ['multiple ' => false],
    'pluginOptions' => ['overwriteInitial' => true,
        'showUpload' => false,
        'initialPreview' => [Url::to(['/media\/'.$model->gambar], true)],
        'initialPreviewFileType' => 'image', // image is the default and can be overridden in config below
    'initialCaption' => $model->gambar,
        'initialPreviewAsData' => true, ], ]); ?>
