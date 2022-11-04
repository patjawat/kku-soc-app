<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TaskSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'step_id') ?>

    <?= $form->field($model, 'status') ?>

    <?= $form->field($model, 'person_id') ?>

    <?= $form->field($model, 'note') ?>

    <?php // echo $form->field($model, 'director') ?>

    <?php // echo $form->field($model, 'basic') ?>

    <?php // echo $form->field($model, 'author') ?>

    <?php // echo $form->field($model, 'visit_date') ?>

    <?php // echo $form->field($model, 'meetting_date') ?>

    <?php // echo $form->field($model, 'reader_result') ?>

    <?php // echo $form->field($model, 'set_result_date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
