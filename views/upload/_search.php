<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UploadSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="uploads-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'upload_id') ?>

    <?= $form->field($model, 'ref') ?>

    <?= $form->field($model, 'file_name') ?>

    <?= $form->field($model, 'real_filename') ?>

    <?= $form->field($model, 'create_date') ?>

    <?php // echo $form->field($model, 'type') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
