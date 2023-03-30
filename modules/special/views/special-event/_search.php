<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\special\models\SpecialEventSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="special-event-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'ref') ?>

    <?= $form->field($model, 'data_json') ?>

    <?= $form->field($model, 'special_date') ?>

    <?= $form->field($model, 'location') ?>

    <?php // echo $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'special_event_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
