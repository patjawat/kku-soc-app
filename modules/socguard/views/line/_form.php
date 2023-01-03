<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\socguard\models\Borrow $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="borrow-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'item_code')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('ยืนยันการเบิก', ['class' => 'btn btn-success','id' => 'btn-save']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
