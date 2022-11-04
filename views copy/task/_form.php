<?php

use yii\helpers\Html;
use yii\web\View;
use yii\bootstrap4\ActiveForm;
use app\models\Step;
use yii\helpers\ArrayHelper;
use kartik\widgets\Select2;


/* @var $this yii\web\View */
/* @var $model app\models\Task */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-form">

    <?php $form = ActiveForm::begin(['id' => 'form-task']); ?>

    <?=
$form->field($model, 'step_id')->widget(Select2::classname(), [
    'data' =>  ArrayHelper::map(Step::find()->all(),'id','name'),
    'options' => ['placeholder' => 'กระบวนการ'],
    'pluginOptions' => [
        'allowClear' => true,
    ],

]);
?>


    <?= $form->field($model, 'person_id')->hiddenInput()->label(false) ?>


    <?php //  $form->field($model, 'director')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'basic')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'author')->textInput() ?>

    <?= $form->field($model, 'visit_date')->textInput() ?>

    <?= $form->field($model, 'meetting_date')->textInput() ?>
    <?= $form->field($model, 'reader_result')->textInput() ?>

    <?= $form->field($model, 'status')->inline()->radioList([
    1=> 'ผ่าน',
        0 => 'ไม่ผ่าน',
    ])->label(false); ?>

    <?= $form->field($model, 'set_result_date')->textInput() ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<?php
$js = <<< JS

$("#form-task").on('beforeSubmit',function (e) {
  e.preventDefault(); // stopping submitting
  var form = $(this);
  var data = $(this).serialize();
var url = $(this).attr('action');

    $.ajax({
        type: "post",
        url: url,
        data:data,
        dataType: "json",
        beforeSend: function() {
            beforLoadModal();
        },
        success: function (res) {
            closeModal();
        }
    });

  return false;
});


JS;
$this->registerJS($js,View::POS_END);
?>
