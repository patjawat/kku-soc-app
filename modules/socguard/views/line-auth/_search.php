<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\bookingcar\models\BookingSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="booking-search">

    <?php $form = ActiveForm::begin([
        'action' => ['signup'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'phone')->textInput() ?>
    <?= $form->field($model, 'line_id')->textInput(['id' => 'line_id'])->label(false); ?>
    <?php //  $form->field($model, 'line_id')->hiddenInput(['id' => 'line_id'])->label(false); ?>

    <div class="d-grid gap-2 col-12 mx-auto">
        <?= Html::submitButton('ตกลง', ['class' => 'btn btn-block btn-primary mt-3']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
