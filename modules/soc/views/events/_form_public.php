<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\DateTimePicker;
use kartik\datecontrol\DateControl;
use kartik\widgets\Select2;
use kartik\widgets\FileInput;



use app\models\Category;

$optiondate = ['type' => DateControl::FORMAT_DATETIME,'language' => 'th',];

/* @var $this yii\web\View */
/* @var $model app\models\Events */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="container">

    <?php $form = ActiveForm::begin(); ?>

    <?=$form->field($model, 'ref')->hiddenInput()->label(false); ?>
    <?php // $form->field($model, 'ref')->textInput()->label(false); ?>

    <div class="info-box shadow-sm">
<div class="info-box-content ">

    <div class="row">
    <div class="col-6">
        <?= $form->field($model, 'fname')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-6">
        <?= $form->field($model, 'lname')->textInput(['maxlength' => true]) ?>
    </div>
    </div>

    </div>
</div>

<div class="info-box shadow-sm">
<div class="info-box-content ">
    <?= $form->field($model, 'person_type')->radioList(ArrayHelper::map(Category::find()->where(['category_type' => 1])->all(),'id','name')) ?>
    </div>
</div>
    <?= $form->field($model, 'department')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textArea(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'event_date')->widget(DateControl::classname(), $optiondate)->label(true)?>

    <?=
$form->field($model, 'event_type')->widget(Select2::classname(), [
    'data' =>  ArrayHelper::map(Category::find()->where(['category_type' => 2])->all(),'id','name'),
    'options' => ['placeholder' => 'เลือกเหตุการณ์'],
    'pluginOptions' => [
        'allowClear' => true,
    ],

]);
?>

    <?= $form->field($model, 'orther')->textArea() ?>

    <?= $form->field($model, 'event_location_note')->textInput(['maxlength' => true]) ?>


    <div class="form-group field-upload_files">
    <label class="control-label" for="upload_files[]"> บัตรประชาชน </label>
    <div>
        <?php echo  FileInput::widget([
                   'name' => 'upload_ajax[]',
                   'options' => ['multiple' => true,'accept' => ['image/*']], //'accept' => 'image/*' หากต้องเฉพาะ image
                    'pluginOptions' => [
                        'overwriteInitial'=>false,
                        'initialPreviewShowDelete'=>true,
                        'initialPreview'=> $initialPreview,
                        'initialPreviewConfig'=> $initialPreviewConfig,
                        'uploadUrl' => Url::to(['/uploads/upload-ajax']),
                        'uploadExtraData' => [
                            'ref' => $model->ref,
                        ],
                        'maxFileCount' => 1,
                        'minFileCount'=> 1,
                    ]
                ]);
    ?>
    </div>
</div>

    <div class="form-group">
        <?= Html::submitButton('<i class="fas fa-check"></i> บันทึก', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
