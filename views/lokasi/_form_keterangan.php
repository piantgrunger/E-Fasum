<?php
use kartik\widgets\FileInput;
use yii\helpers\Url;
use yii\helpers\Html;

$allimage = array();
$doc_image = explode('&&', $model->foto_dokumen);

foreach ($doc_image as $eachimage) {
    if ($eachimage !== '') {
        $allimage[] = Url::to(['/media/'.$eachimage]);
    }
}

?>
    <?= $form->field($model, 'file_dokumen[]')->widget(FileInput::classname(), [
    'options' => ['multiple ' => true],
    'pluginOptions' => ['overwriteInitial' => true,
        'showUpload' => false,
       'initialPreview' => $allimage,
        'initialPreviewFileType' => 'pdf', // image is the default and can be overridden in config below
        'initialPreviewAsData' => true, ], ]); ?>

<div class="text-bold">Luas Tanah (M2)</div>
<div class="text"><p id="luas_tanah2" ><?=$model->luas_tanah; ?></p></div>
<?= $form->field($model, 'nilai_satuan')->textInput(['maxlength' => true]); ?>
<?= $form->field($model, 'total_nilai')->textInput(['readOnly' => true]); ?>
