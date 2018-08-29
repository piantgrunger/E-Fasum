<?php
use yii\helpers\Html;
use yii\helpers\Url;

$js = "$('#modalButton-$key').click(function (){
    console.log('Hyy');
    $('#modal').modal('show')
        .find('#modalContent')
        .load($(this).attr('value'));
});";
$this->registerJS($js);

?>


<td>
<?= $form->field($model, "[$key]latitude")->textInput(['maxlength' => true])->label(false); ?>
</td><td>
    <?= $form->field($model, "[$key]longitude")->textInput(['maxlength' => true])->label(false); ?>

</td>

<td>  
<p>
 <?= Html::button('Peta', ['value' => Url::to(['/lokasi/peta', 'key' => $key]), 'class' => 'btn btn-success', 'id' => 'modalButton-'.$key]); ?>
 </p>

</td>
<td>
    <a data-action="delete"><span class="glyphicon glyphicon-trash">

<?=$form->field($model, "[$key]id_d_lokasi")->hiddenInput()->label(false); ?>

</td>
