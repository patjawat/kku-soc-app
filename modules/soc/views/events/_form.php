<?php

use yii\web\View;
use app\models\Category;
use app\modules\usermanager\models\User;
use kartik\datecontrol\DateControl;
use kartik\select2\Select2;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\FileInput;

use app\components\SystemHelper;

$optiondate = ['type' => DateControl::FORMAT_DATETIME, 'language' => 'th'];

?>


<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

<div class="alert alert-info" role="alert">
    <strong><i class="far fa-edit"></i> ข้อมูลพื้นฐาน</strong>
</div>
<?php
            //    echo $model->ref; 
               
                ;?>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-4">
                <div class="card-img">
          
                    <?=$model->getIdCart()?>
                    <span class="btn btn-primary btn-block" id="cidSelect">เลือกไฟล์บัตรประชาชน</span>

                </div>
            </div>
            <div class="col-8">

                <div class="row">
                    <div class="col-6">
                        <?=$form->field($model, 'fname')->textInput(['maxlength' => true])?>
                        <?=$form->field($model, 'phone')->textInput(['maxlength' => true])?>

                    </div>
                    <div class="col-6">
                        <?=$form->field($model, 'lname')->textInput(['maxlength' => true])?>
                        <?=$form->field($model, 'department')->textInput(['maxlength' => true])->label('คณะ/หน่วยงาน');?>

                    </div>
                </div>
                <div class="row">

                    <div class="col-12">

                        <?=$form->field($model, 'person_type')->inline()->radioList(ArrayHelper::map(Category::find()->where(['category_type' => 1])->all(), 'id', 'name'))?>

                    </div>
                </div>

            </div>
            <!-- End col-8 -->
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
        <?=$form->field($model, 'event_type')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(Category::find()->where(['category_type' => 2])->all(), 'id', 'name'),
    'options' => ['placeholder' => 'Select', 'multiple' => false],
])->label(true);
?>
        <div class="row">
            <div class="col-6">

                <?=$form->field($model, 'event_date')->widget(DateControl::classname(), $optiondate)->label(true)?>

            </div>
            <div class="col-6">
            <?=$form->field($model, 'event_location_note')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(Category::find()->where(['category_type' => 4])->all(), 'id', 'name'),
    'options' => ['placeholder' => 'Select', 'multiple' => false],
])->label(true);
?>
            </div>
        </div>


        <div class="row">
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
    <strong><i class="far fa-edit"></i> สรุปผล (ผู้รายงานเหตุ : <code><?=$model->getUser()?></code>)</strong>
</div>

<div class="card">
    <div class="card-body">

        <div class="row">
            <div class="col-6">
                <?=$form->field($model, 'backup_to')->textInput()?>
                <div class="alert alert-success" role="alert">
                <?=$form->field($model, 'result')->inline()->radioList(ArrayHelper::map(Category::find()->where(['category_type' => 5])->all(), 'id', 'name'))?>
            </div>
            </div>
            <div class="col-6">
                <?=$form->field($model, 'worker')->widget(Select2::classname(), [
    'hideSearch' => true,
    'data' => ArrayHelper::map(User::find()->all(), 'id', 'fullname'),
    'options' => ['placeholder' => 'Select', 'multiple' => true],
])->label(true);
?>
            </div>
        </div>
        <?php echo $form->field($model, 'note')->widget(CKEditor::className(), ['editorOptions' => ElFinder::ckeditorOptions('elfinder')]) ?>

    </div>
    <!-- End Card Body -->
</div>
<!-- End Card -->



<div class="alert alert-info alert-dismissible" role="info">
    <!-- <strong><i class="far fa-edit"></i> ภาพเหตุการ</strong>
    <button type="button" class="close" data-dismiss="alert">
        <span ><i class="fas fa-cloud-upload-alt"></i></span>
    </button> -->
    <div class="d-flex">
  <div class="p-2"><i class="far fa-edit"></i> ภาพเหตุการ</div>
  <div class="ml-auto p-2">
    <?=Html::a('<i class="fas fa-cloud-upload-alt"></i>',['/soc/events/upload-form'],['class' =>'a-modal text-info']);?>
  </div>
</div>
</div>


<div class="card">
    <div class="card-body">
<?php
// echo $form->field($model, 'files[]')->widget(FileInput::classname(), [
//     'options' => ['multiple' => true, 'accept' => 'image/*'],
//     // 'pluginOptions' => ['previewFileType' => 'image']
//     'pluginOptions' => [
//                 'overwriteInitial' => true,
//                 'initialPreviewShowDelete' => true,
//                 'initialPreview' => $initialPreview,
//                 'initialPreviewConfig' => $initialPreviewConfig,
//                 'uploadUrl' => Url::to(['/soc/events/upload-ajax']),
//                 'uploadExtraData' => [
//                     'ref' => $model->ref,
//                     'category_id' => 16,
//                 ],
//                 'maxFileCount' => 100,
//             ],
// ]);
?>
<div class="form-group field-upload_files">
      <label class="control-label" for="upload_files[]"> ภาพถ่าย </label>
    <div>
    <?php 
        echo FileInput::widget([
    'name' => 'upload_ajax[]',
    'id' => 'input107',
    'options' => ['multiple' => true, 'accept' => ['*']], //'accept' => 'image/*' หากต้องเฉพาะ image
    'pluginOptions' => [
        'overwriteInitial' => true,
        'initialPreviewShowDelete' => true,
        'initialPreview' => $initialPreview,
        'initialPreviewConfig' => $initialPreviewConfig,
        'uploadUrl' => Url::to(['/soc/events/upload-ajax']),
        'uploadExtraData' => [
            'ref' => $model->ref,
            'category_id' => 16,
        ],
        'maxFileCount' => 100,
    ],
]);
?>

    </div><!-- End Card Body -->
</div><!-- End Card -->

<div class="form-group">
    <?=Html::submitButton('<i class="fas fa-check"></i> บันทึก', ['class' => 'btn btn-success'])?>
</div>

<?php ActiveForm::end();?>

<?php

$formUploadUrl = Url::to(['/soc/events/form-upload','id' => $model->id]);
$js = <<< JS

$('#cidSelect').click(function (e) { 
    e.preventDefault();
    console.log('Click');
    $.ajax({
        type: "get",
        url: "$formUploadUrl",
        // data: "data",
        beforeLoad: function () {
            beforLoadModal();
        },
        dataType: "json",
        success: function (response) {
            $('#main-modal').modal('show');
            $('#main-modal-label').html(response.title);
            $('.modal-body').html(response.content);
            $('.modal-footer').html(response.footer);
            $(".modal-dialog").removeClass('modal-sm');
            $(".modal-dialog").addClass('modal-lg');
            $('.modal-content').addClass('card-outline card-primary');
        }
    });
    
});


$('#input-id').on('filebatchuploadsuccess', function(event, data) {
    var form = data.form, files = data.files, extra = data.extra,
        response = data.response, reader = data.reader;
    console.log('File batch upload success');
});

JS;
$this->registerJs($js,View::POS_END);
?>