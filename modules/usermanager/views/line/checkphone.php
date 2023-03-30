<?php
use yii\web\View;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
?>
<div class="container p-3">

    <?php $form = ActiveForm::begin(['id' => 'registerForm','action' => ['register-user']]); ?>
    <?= $form->field($model, 'line_id')->hiddenInput(['maxlength' => true,'id' =>'line_id'])->label(false); ?>
    <?= $form->field($model, 'phone')->textInput(['maxlength' => true])->label('กรุณากรอกหมายเลขโทรศีพท์'); ?>
    
    <div class="form-group">
        <?= Html::submitButton('คลิกเพื่อยืนยัน', ['class' => 'btn btn-block btn-primary', 'name' => 'signup-button']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>