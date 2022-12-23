<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\Select2;
use app\models\Prefix;

/* @var $this yii\web\View */
/* @var $model app\models\Reader */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reader-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=
$form->field($model, 'prefix')->widget(Select2::classname(), [
    'data' =>  ArrayHelper::map(Prefix::find()->all(),'id','name'),
    'options' => ['placeholder' => 'คำนำหน้า'],
    'pluginOptions' => [
        'allowClear' => true,
    ],
]);
?>
    <?= $form->field($model, 'fullname')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
