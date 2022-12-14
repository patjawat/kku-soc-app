<?php

use yii\helpers\Html;
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

    <?= $form->field($model, 'ref')->hiddenInput()->label(false); ?>

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

    <?= $form->field($model, 'work_img')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'docs[]')->widget(FileInput::classname(), [
   'options' => [
       //'accept' => 'image/*',
       'multiple' => true
   ],
   'pluginOptions' => [
       'initialPreview'=>$model->initialPreview($model->docs,'docs','file'), //<-----
       'initialPreviewConfig'=>$model->initialPreview($model->docs,'docs','config'),//<-----
       'allowedFileExtensions'=>['pdf','doc','docx','xls','xlsx'],
       'showPreview' => true,
       'showCaption' => true,
       'showRemove' => true,
       'showUpload' => false,
       'overwriteInitial'=>false
    ]
   ]); ?>

    <?= $form->field($model, 'result')->textInput() ?>

    <?= $form->field($model, 'note')->textInput() ?>

    <?= $form->field($model, 'backup_to')->textInput() ?>

    <?= $form->field($model, 'backup_type')->textInput() ?>

    <?= $form->field($model, 'reporter')->textInput() ?>

    <?= $form->field($model, 'worker')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
