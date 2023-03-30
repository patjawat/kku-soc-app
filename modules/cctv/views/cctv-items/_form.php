<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\cctv\models\CctvItems $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="cctv-items-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true])->label('IP-Address'); ?>
    <?= $form->field($model, 'cctv_location_id')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'active')->radioList([true => 'เปิด',false => 'ปิด']) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
