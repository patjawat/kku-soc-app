<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;
use kartik\widgets\FileInput;
use mihaildev\ckeditor\CKEditor;
/* @var $this yii\web\View */
/* @var $model app\models\Events */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="events-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="alert alert-info" role="alert">
        <strong>ข้อมูลพื้นฐาน</strong>
    </div>
    
    <div class="row">
        <div class="col-3">
            <?= $form->field($model, 'fname')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-3">
            <?= $form->field($model, 'lname')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-6">
            <?= $form->field($model, 'person_type')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-3">
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-3">
            <?= $form->field($model, 'department')->textInput(['maxlength' => true])->label('คณะ/หน่วยงาน'); ?>
        </div>
        <div class="col-3">
            <?= $form->field($model, 'event_type')->textInput() ?>
        </div>
    </div>


    <div class="row">
        <div class="col-6">
            <?= $form->field($model, 'address')->textArea(['maxlength' => true,'rows' => 5]) ?>
        </div>
        <div class="col-6">
          
        </div>
    </div>

    <div class="alert alert-info" role="alert">
        <strong>รายละเอียดเหตุการ์</strong>
    </div>
    <?= $form->field($model, 'event_date')->textInput() ?>
            <?= $form->field($model, 'orther')->textArea() ?>
    <?= $form->field($model, 'event_location_note')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'work_img')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'docs')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'result')->inline()->radioList([
        1 => 'พบเหตุการณ์',
        2 => 'ไม่พบเหตุการณ์'
     ]) ?>

    <?php echo $form->field($model, 'note')->widget(CKEditor::className(),[
    'editorOptions' => [
        'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
        'inline' => false, //по умолчанию false
    ],
]) ?>


    <?= $form->field($model, 'backup_to')->textInput() ?>

    <?= $form->field($model, 'backup_type')->textInput() ?>

    <?= $form->field($model, 'reporter')->textInput() ?>

    <?= $form->field($model, 'worker')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <div class="form-group field-upload_files">
        <label class="control-label" for="upload_files[]"> ภาพถ่าย </label>
        <div>
            <?= FileInput::widget([
                   'name' => 'upload_ajax[]',
                   'options' => ['multiple' => true,'accept' => ['image/*','video/*']], //'accept' => 'image/*' หากต้องเฉพาะ image
                    'pluginOptions' => [
                        'overwriteInitial'=>false,
                        'initialPreviewShowDelete'=>true,
                        'initialPreview'=> $initialPreview,
                        'initialPreviewConfig'=> $initialPreviewConfig,
                        'uploadUrl' => Url::to(['/uploads/upload-ajax']),
                        'uploadExtraData' => [
                            'ref' => $model->ref,
                        ],
                        'maxFileCount' => 100
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