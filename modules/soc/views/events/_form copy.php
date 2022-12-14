<?php

use app\models\Category;
use app\modules\usermanager\models\User;
use kartik\datecontrol\DateControl;
use kartik\select2\Select2;
use kartik\widgets\FileInput;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

$optiondate = ['type' => DateControl::FORMAT_DATETIME, 'language' => 'th'];

?>


    <?php $form = ActiveForm::begin();?>
    <div class="alert alert-info" role="alert">
        <strong><i class="far fa-edit"></i> ข้อมูลพื้นฐาน</strong>
    </div>

    <div class="card">
        <div class="card-body">


            <div class="row">
                <div class="col-3">
                    <?=$form->field($model, 'fname')->textInput(['maxlength' => true])?>
                </div>
                <div class="col-3">
                    <?=$form->field($model, 'lname')->textInput(['maxlength' => true])?>
                </div>
                <div class="col-6">
                    <?=$form->field($model, 'event_type')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(Category::find()->where(['category_type' => 2])->all(), 'id', 'name'),
    'options' => ['placeholder' => 'Select', 'multiple' => false],
])->label(true);
?>
                </div>
            </div>

            <div class="row">
                <div class="col-3">
                    <?=$form->field($model, 'phone')->textInput(['maxlength' => true])?>
                </div>
                <div class="col-3">
                    <?=$form->field($model, 'department')->textInput(['maxlength' => true])->label('คณะ/หน่วยงาน');?>
                </div>
                <div class="col-6">
                    <?=$form->field($model, 'person_type')->inline()->radioList(ArrayHelper::map(Category::find()->where(['category_type' => 1])->all(), 'id', 'name'))?>

                </div>
            </div>


            <div class="row">
                <div class="col-12">
                    <?=$form->field($model, 'address')->textArea(['maxlength' => true, 'rows' => 3])?>
                </div>
            </div>

        </div>
        <!-- End Card Body -->
    </div>
    <!-- End Card -->


    <div class="alert alert-info" role="alert">
        <strong><i class="far fa-edit"></i> รายละเอียดเหตุการ์</strong>
    </div>
    <div class="card">
        <div class="card-body">

            <div class="row">
                <div class="col-6">
                <?=$form->field($model, 'event_date')->widget(DateControl::classname(), $optiondate)->label(true)?>

                </div>
                <div class="col-6">
                    <?=$form->field($model, 'event_location_note')->textInput(['maxlength' => true])?>
                </div>
            </div>
        </div>
        <div class="row pl-3 pr-3">
            <div class="col-12">
                <?=$form->field($model, 'orther')->textArea()?>
                <?=$form->field($model, 'work_img')->textInput(['maxlength' => true])?>
                <?=$form->field($model, 'docs')->textInput(['maxlength' => true])?>
            </div>
        </div>
    </div>
    <!-- End Card Body -->
</div>
<!-- End Card -->

<div class="alert alert-info" role="alert">
    <strong><i class="far fa-edit"></i> สรุปผล</strong>
</div>

<div class="card">
    <div class="card-body">

        <div class="row">
            <div class="col-6">
                <?=$form->field($model, 'reporter')->textInput()?>
                <?=$form->field($model, 'result')->inline()->radioList([
    1 => 'พบเหตุการณ์',
    2 => 'ไม่พบเหตุการณ์',
])?>

            </div>
            <div class="col-6">
                <?=$form->field($model, 'backup_to')->textInput()?>
                <?=$form->field($model, 'worker')->widget(Select2::classname(), [
    'hideSearch' => true,
    'data' => ArrayHelper::map(User::find()->all(), 'id', 'fullname'),
    'options' => ['placeholder' => 'Select', 'multiple' => true],
])->label(true);
?>

            </div>
        </div>


        <?php echo $form->field($model, 'note')->widget(CKEditor::className(), [
    'editorOptions' => ElFinder::ckeditorOptions('elfinder'),
    // 'editorOptions' => [
    //     'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
    //     'inline' => false, //по умолчанию false
    // ],
]) ?>
    </div>
    <!-- End Card Body -->
</div>
<!-- End Card -->

<div class="form-group field-upload_files">
    <label class="control-label" for="upload_files[]"> ภาพถ่าย </label>
    <?php
// print_r($initialPreview);
// echo '<pre>';
// print_r($initialPreviewConfig);
// echo '</pre>';
?>
    <div>
        <?php 
//         echo FileInput::widget([
//     'name' => 'upload_ajax[]',
//     'options' => ['multiple' => true, 'accept' => ['image/*', 'video/*']], //'accept' => 'image/*' หากต้องเฉพาะ image
//     'pluginOptions' => [
//         'overwriteInitial' => false,
//         'initialPreviewShowDelete' => true,
//         'initialPreview' => $initialPreview,
//         'initialPreviewConfig' => $initialPreviewConfig,
//         'uploadUrl' => Url::to(['/uploads/upload-ajax']),
//         'uploadExtraData' => [
//             'ref' => $model->ref,
//             'category_id' => 16,
//         ],
//         'maxFileCount' => 100,
//     ],
// ]);
?>
    </div>
</div>

<div class="form-group">
    <?=Html::submitButton('<i class="fas fa-check"></i> บันทึก', ['class' => 'btn btn-success'])?>
</div>

<?php ActiveForm::end();?>
