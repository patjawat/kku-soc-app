<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EventsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="events-search">

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

    <?= $form->field($model, 'fname') ?>

    <?= $form->field($model, 'lname') ?>

    <?php // echo $form->field($model, 'fullname') ?>

    <?php // echo $form->field($model, 'person_type') ?>

    <?php // echo $form->field($model, 'department') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'event_date') ?>

    <?php // echo $form->field($model, 'event_type') ?>

    <?php // echo $form->field($model, 'orther') ?>

    <?php // echo $form->field($model, 'event_location_note') ?>

    <?php // echo $form->field($model, 'las') ?>

    <?php // echo $form->field($model, 'long') ?>

    <?php // echo $form->field($model, 'work_img') ?>

    <?php // echo $form->field($model, 'docs') ?>

    <?php // echo $form->field($model, 'result') ?>

    <?php // echo $form->field($model, 'note') ?>

    <?php // echo $form->field($model, 'backup_to') ?>

    <?php // echo $form->field($model, 'backup_type') ?>

    <?php // echo $form->field($model, 'reporter') ?>

    <?php // echo $form->field($model, 'worker') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
