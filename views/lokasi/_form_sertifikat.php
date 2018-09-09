<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;
use yii\helpers\Url;

$js = <<<JS
  $(document).ready(function()
    {
  if ($("#lokasi-pagar").val() === "Ya") {
    document.getElementById("pagar").style.display="block";
} else {
    document.getElementById("pagar").style.display="none";
}

 if ($("#lokasi-pondasi").val() === "Ya") {
    document.getElementById("pondasi").style.display="block";
} else {
    document.getElementById("pondasi").style.display="none";
}


 if ($("#lokasi-patok").val() === "Ya") {
    document.getElementById("patok").style.display="block";
} else {
    document.getElementById("patok").style.display="none";
}



 if ($("#lokasi-papan_nama").val() === "Ya") {
    document.getElementById("papan_nama").style.display="block";
} else {
    document.getElementById("papan_nama").style.display="none";
}


    })


    $("#lokasi-papan_nama").on("change", function (e)
    {
  if ($("#lokasi-papan_nama").val() === "Ya") {
    document.getElementById("papan_nama").style.display="block";
} else {
    document.getElementById("papan_nama").style.display="none";
}
    });;

    $("#lokasi-pondasi").on("change", function (e)
    {
  if ($("#lokasi-pondasi").val() === "Ya") {
    document.getElementById("pondasi").style.display="block";
} else {
    document.getElementById("pondasi").style.display="none";
}
    });

    $("#lokasi-pagar") . on("change", function (e)
    {
  if ($("#lokasi-pagar") . val() === "Ya") {
    document.getElementById("pagar").style.display="block";
} else {
    document.getElementById("pagar").style.display="none";
}
    });



JS;
$this->registerJS($js);


?>

      <?= $form->field($model, 'gambar')->widget(FileInput::classname(), [
            'options' => ['multiple ' => false],
            'pluginOptions' => [
                'overwriteInitial' => true,
                'showUpload' => false,
                'initialPreview' => [Url::to(['/media\/' . $model->gambar], true)],
                'initialPreviewFileType' => 'image', // image is the default and can be overridden in config below
                'initialCaption' => $model->gambar,
                'initialPreviewAsData' => true,
            ],
        ]); ?>
<?= $form->field($model, 'pagar')->dropDownList(
    [
        'Ya' =>'Ya',
        'Tidak' => 'Tidak',


    ],
    ['prompt' => '']
);
?>
<div id="pagar">
      <?= $form->field($model, 'gambar_pagar')->widget(FileInput::classname(), [
            'options' => ['multiple ' => false],
            'pluginOptions' => [
                'overwriteInitial' => true,
                'showUpload' => false,
                'initialPreview' => [Url::to(['/media\/' . $model->gambar_pagar], true)],
                'initialPreviewFileType' => 'image', // image is the default and can be overridden in config below
                'initialCaption' => $model->gambar_pagar,
                'initialPreviewAsData' => true,
            ],
        ]); ?>
</div>

<?= $form->field($model, 'pondasi')->dropDownList(
    [
        'Ya' => 'Ya',
        'Tidak' => 'Tidak',


    ],
    ['prompt' => '']
);
?>
<div id="pondasi">
      <?= $form->field($model, 'gambar_pondasi')->widget(FileInput::classname(), [
            'options' => ['multiple ' => false],
            'pluginOptions' => [
                'overwriteInitial' => true,
                'showUpload' => false,
                'initialPreview' => [Url::to(['/media\/' . $model->gambar_pondasi], true)],
                'initialPreviewFileType' => 'image', // image is the default and can be overridden in config below
                'initialCaption' => $model->gambar_pondasi,
                'initialPreviewAsData' => true,
            ],
        ]); ?>
</div>


<?= $form->field($model, 'patok')->dropDownList(
    [
        'Ya' => 'Ya',
        'Tidak' => 'Tidak',


    ],
    ['prompt' => '']
);
?>
<div id="patok">
      <?= $form->field($model, 'gambar_patok')->widget(FileInput::classname(), [
            'options' => ['multiple ' => false],
            'pluginOptions' => [
                'overwriteInitial' => true,
                'showUpload' => false,
                'initialPreview' => [Url::to(['/media\/' . $model->gambar_patok], true)],
                'initialPreviewFileType' => 'image', // image is the default and can be overridden in config below
                'initialCaption' => $model->gambar_patok,
                'initialPreviewAsData' => true,
            ],
        ]); ?>
</div>


<?= $form->field($model, 'papan_nama')->dropDownList(
    [
        'Ya' => 'Ya',
        'Tidak' => 'Tidak',


    ],
    ['prompt' => '']
);
?>
<div id="papan_nama">
      <?= $form->field($model, 'gambar_papan_nama')->widget(FileInput::classname(), [
            'options' => ['multiple ' => false],
            'pluginOptions' => [
                'overwriteInitial' => true,
                'showUpload' => false,
                'initialPreview' => [Url::to(['/media\/' . $model->gambar_papan_nama], true)],
                'initialPreviewFileType' => 'image', // image is the default and can be overridden in config below
                'initialCaption' => $model->gambar_papan_nama,
                'initialPreviewAsData' => true,
            ],
        ]); ?>
</div>
