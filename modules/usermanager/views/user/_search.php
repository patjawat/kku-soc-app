<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

?>
<style>
.form-group {
    margin-bottom: 0rem;
}
.form-control:focus {
    color: #212529;
    background-color: #fff;
    border-color: #86b7fe;
    outline: 0;
    box-shadow: 0 0 20px 0rem rgb(13 110 253 / 25%) !important;
}
</style>

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <?= $form->field($model, 'q', [
        'inputTemplate' => 
        '<div class="input-group">{input}'.Html::submitButton('<i class="fas fa-search"></i>', 
        ['class' => 'btn btn-secondary']).'</div>',
    ])->textInput(['class' => 'form-control float-righ','placeholder' => 'ค้นหา', 'autofocus' => 'autofocus'])->label(false); ?>
    <?php ActiveForm::end(); ?>

    <?php 
    // $form->field($model, 'q', [
    //     'inputTemplate' => 
    //     '<div class="input-group">{input}'.Html::submitButton('<i class="fas fa-search"></i>', 
    //     ['class' => 'btn btn-default']).'&nbsp;'
    //     .Html::a('<i class="fas fa-plus"></i>', ['create'], ['class' => 'btn btn-success']).'&nbsp;'
    //     .Html::a('<i class="fas fa-redo"></i>', [''], ['class' => 'btn btn-secondary']).'</div>',
    // ])->textInput(['class' => 'form-control float-righ','placeholder' => 'ค้นหา', 'autofocus' => 'autofocus'])->label(false);
     ?>

<?php
$js = <<< JS
$('#usersearch-q').select();
JS;
$this->registerJS($js);
?>