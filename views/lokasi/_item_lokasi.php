<?php

$js = "$('#modalButton-$key').click(function (){
    console.log('Hyy');
    $('#modal').modal('show')
        .find('#modalContent')
        .load($(this).attr('value'));
});";
$this->registerJS($js);

?>
<td><?= $form->field($model, "[$key]posisi")->textInput(['maxlength' => true])->label(false); ?></td>

<td>
<?= $form->field($model, "[$key]koordinat")->textInput(['maxlength' => true])->label(false); ?>



<?=$form->field($model, "[$key]id_d_lokasi")->hiddenInput()->label(false); ?>


</td>
