<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Tabs;
use yii\bootstrap\Modal;
use dosamigos\google\maps\MapAsset;

MapAsset::register($this);

/* @var $this yii\web\View */
/* @var $model app\models\Lokasi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lokasi-form">


<?php
        Modal::begin([
                'header' => '<h4>Peta</h4>',
                'id' => 'modal',
                'size' => 'modal-lg',
            ]);
        echo "<div id='modalContent'></div>";
        Modal::end();
    ?>


    <?php $form = ActiveForm::begin(); ?>
        <?= $form->errorSummary($model); ?> <!-- ADDED HERE -->
<?php
    $item =
[
    [
        'label' => 'Pengamanan Administrasi ',
        'content' => $this->render('_form_lokasi', ['model' => $model, 'form' => $form]),
        'active' => true,
    ],
    [
        'label' => 'Pengamanan Fisik',
        'content' => $this->render('_form_sertifikat', ['model' => $model, 'form' => $form]),
    ],
        [
        'label' => 'Pengamanan Hukum',
        'content' => $this->render('_form_keterangan', ['model' => $model, 'form' => $form]),
    ],
];

    echo Tabs::widget([
        'items' => $item, ]);

?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']); ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
