<?php

use yii\helpers\Html;
use kartik\datecontrol\DateControl;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\Select2;
use app\models\Reader;
$optiondate = ['type' => DateControl::FORMAT_DATE,'language' => 'th',];

/* @var $this yii\web\View */
/* @var $model app\models\PersonTask */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="person-task-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'person_id')->hiddenInput()->label(false) ?>
    <?=
$form->field($model, 'reader_id')->widget(Select2::classname(), [
    'data' =>  ArrayHelper::map(Reader::find()->all(),'id','fullname'),
    'options' => ['placeholder' => 'reader'],
    'pluginOptions' => [
        'allowClear' => true,
    ],
]);
?>

    <?= $form->field($model, 'checkup')->inline()->radioList([
    1=> 'ผ่าน',
        0 => 'ไม่ผ่าน',
    ])->label(true); ?>
    
    <?= $form->field($model, 'reader_fix_date')->widget(DateControl::classname(), $optiondate)->label(true)?>
    <?= $form->field($model, 'reader_result_date')->widget(DateControl::classname(), $optiondate)->label(true)?>
    <?= $form->field($model, 'guidelines_date')->widget(DateControl::classname(), $optiondate)->label(true)?>

    <div class="form-group">
        <?= Html::submitButton('<i class="fas fa-check"></i> บันทึก', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
