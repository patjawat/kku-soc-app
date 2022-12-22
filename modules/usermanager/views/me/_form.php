<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
?>


<style>
.form-group>label {
    text-align: end;
    font-size: 15px;
}

.form-horizontal .control-label {
    padding-top: 7px;
    margin-bottom: 0;
    text-align: right;
}

.help-block {
    display: block;
    margin-top: 0px;
    margin-bottom: 0px;
    color: #737373;
}

.form-group {
    margin-bottom: 5px;
}

.card-top {
    width: 100%;
    display: inline-block;
    border-radius: 5px;
    padding: 10px 30px;
    border-top: 2px solid var(--color-blue-d);
    box-shadow: 0px 6px 6px 0px rgba(0, 0, 0, 0.15);
    text-align: left;
    color: var(--color-gray-xd);
    text-decoration: none;
    margin-bottom: 1rem;
}

.custom-control-label::before {
    left: -24px !important;
}

.custom-control-label::after {
    left: -24px !important;
}

.alert-primary {
    color: #004085 !important;
    background-color: #cce5ff !important;
    border-color: #b8daff !important;
}

.box-img {
    position: relative;
    /* width:500px; */
}

.box-img>img {
    width: 200px;
}
</style>
<div class="row">

    <div class="col-6">
<?php $form = ActiveForm::begin([
    'id' => 'form-usermanager',
    'fieldConfig' => [
        'horizontalCssClasses' => [
            'label' => 'col-lg-4 col-md-4 col-sm-4',
            'wrapper' => 'col-lg-8 col-md-8 col-sm-8',
        ],
    ],
    'layout' => 'horizontal',
]); ?>
    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'confirm_password')->passwordInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'fullname')->textInput(['maxlength' => true]) ?>
                    <?php //  $form->field($model, 'fullname_en')->textInput(['maxlength' => true]) ?>
                    <?php //  $form->field($model, 'doctor_id')->textInput(['maxlength' => true]) ?>
                    <?php //  $form->field($model, 'license_number')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'data_json[link]')->textInput(['maxlength' => true,'placeholder' =>'เช่น https://docs.google.com/'])->label('แบบประเมิน Link') ?>
                    <div class="box-img text-center">
                    <?= Html::img(['/file','id'=>$model->photo],['class' => 'rounded','style' => 'width:200px']) ?>
                        <?= $form->field($model,'file')->fileInput()->label('&nbsp'); ?>
                    </div>

                    <br>

                    <div class="form-group row field-user-phone">
<label class="col-lg-4 col-md-4 col-sm-4" for="user-phone">&nbsp;</label>
<div class="col-lg-8 col-md-8 col-sm-8">


                    <?= Html::submitButton('<i class="fa-solid fa-check"></i> บันทึก', ['class' => 'btn btn-success']) ?>

<?= Html::a('<i class="fas fa-redo"></i> ยกเลิก', ['/me/index'], ['class' => 'btn btn-secondary link-loading', 'title' =>  'Reset Grid']) ?>

<div class="invalid-feedback "></div>

</div>
</div>

                <?php ActiveForm::end(); ?>
    </div>
</div>

