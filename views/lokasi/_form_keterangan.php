<?php
use kartik\widgets\FileInput;
use yii\helpers\Url;

?>
    <?= $form->field($model, 'file_dokumen[]')->widget(FileInput::classname(), [
    'options' => ['multiple ' => true],
    'pluginOptions' => ['overwriteInitial' => true,
        'showUpload' => false,
      //  'initialPreview' => [Url::to(['/media\/'.$model->gambar], true)],
        'initialPreviewFileType' => 'image', // image is the default and can be overridden in config below
        'initialPreviewAsData' => true, ], ]); ?>
