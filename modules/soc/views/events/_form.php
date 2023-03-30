<?php

use app\models\Category;
use app\modules\usermanager\models\User;
use kartik\datecontrol\DateControl;
use kartik\widgets\DateTimePicker;
use kartik\select2\Select2;
use kartik\widgets\FileInput;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$optiondate = ['type' => DateControl::FORMAT_DATETIME, 'language' => 'th'];

?>

<style>
.form-group>label {
    text-align: end;
    font-size: 15px;
}

.form-group {
    margin-bottom: 0.3rem;
}

.view-cid {
    position: relative;
    height: 190px;

}

.view-cid>img {
    position: absolute;
    margin-top: 0px;
    margin-left: 0;
    margin-right: 0;
    width: 250px;
}

.file-zoom-content .file-preview-image {
    /* max-height: 100%; */
    width: 100%;
}
</style>

<?php $form = ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data'],
    'layout' => 'horizontal',
    'fieldConfig' => [
        'horizontalCssClasses' => [
            'label' => 'col-lg-3 col-md-4 col-sm-4',
            'wrapper' => 'col-lg-8 col-md-8 col-sm-8 offset-sm-0',
        ],
    ],
]);?>


<div class="row">
    <div class="col-8">

        <div class="alert alert-info" role="alert">
            <strong><i class="far fa-edit"></i> ข้อมูลเบื้องต้น</strong>
        </div>
        <?php
echo $form->field($model, 'created_at')->widget(DateTimePicker::classname(), [
    'options' => ['placeholder' => 'เลือกวันเวลาที่แจ้ง...'],
    'language' => 'th',
    'pluginOptions' => [
        'autoclose' => true
    ]
])->label('วันเวลาที่แจ้ง');
?>
        <?=$form->field($model, 'fname')->textInput(['maxlength' => true])->label('ชื่อ-สกุล')?>
        <?=$form->field($model, 'lname')->textInput(['maxlength' => true])->label(true)?>
        <?=$form->field($model, 'phone')->textInput(['maxlength' => true])?>
        <?=$form->field($model, 'person_type')->inline()->radioList(ArrayHelper::map(Category::find()->where(['category_type' => 1])->all(), 'id', 'name'))?>
        <?=$form->field($model, 'event_type')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(Category::find()->where(['category_type' => 2])->all(), 'id', 'name'),
    'options' => ['placeholder' => 'เลือก' . $model->getAttributeLabel('event_type') . '...', 'multiple' => false],
])->label(true);
?>
        <?=$form->field($model, 'department')->textInput(['maxlength' => true])->label('คณะ/หน่วยงาน');?>


        <?php
echo $form->field($model, 'event_date')->widget(DateTimePicker::classname(), [
    'options' => ['placeholder' => 'เลือกวันเวลาที่เกิดเหตุ ...'],
    'language' => 'th',
    'pluginOptions' => [
        'autoclose' => true
    ]
]);
?>
        <?=$form->field($model, 'event_location_note')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(Category::find()->where(['category_type' => 4])->all(), 'id', 'name'),
    'options' => ['placeholder' => 'เลือก' . $model->getAttributeLabel('event_location_note') . '...', 'multiple' => false],
])->label(true);
?>
        <?=$form->field($model, 'data_json[location_other]')->textInput(['maxlength' => true])->label('ระบุสถานที่อื่นๆ');?>

        <?=$form->field($model, 'orther')->textArea(['rows' => 5])?>

    </div>
    <div class="col-4">

        <div class="alert alert-info" role="alert">
            <strong><i class="far fa-edit"></i> บัตรประชาชน/บัตรนักศึกษา</strong>
            <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button> -->
            <span class="btn btn-primary" id="cidSelect">เลือกไฟล์</span>
        </div>
        <div class="view-cid">
            <?=$model->getIdCart()?>
        </div>

        <div class="alert alert-info" role="alert">
            <strong><i class="fas fa-signature"></i> ลายเซ็นต์</strong>
        </div>
        <div class="info-box shadow-none">
            <div class="info-box-content">
                <?=Html::img('@web/signature/'.$model->ref.'.jpg',['style' => 'width:207px;'])?>

            </div>

        </div>

    </div>
</div>

<div class="alert alert-info" role="alert">
    <strong><i class="far fa-edit"></i> สรุปผล (ผู้รายงานเหตุ : <code><?=$model->getUser()?></code>)</strong>
</div>


<div class="row">

    <div class="col-8">
        <?=$form->field($model, 'worker')->widget(Select2::classname(), [
                    'hideSearch' => true,
                    'data' => ArrayHelper::map(User::find()->all(), 'id', 'fullname'),
                    'options' => ['placeholder' => 'เลือก' . $model->getAttributeLabel('worker') . '...', 'multiple' => true],
                    ])->label(true);
                    ?>
        <?php echo $form->field($model, 'note')->textarea(['rows' => 10])->label(true) ?>
        <?=$form->field($model, 'backup_to')->textInput()?>
        <?=$form->field($model, 'result')->inline()->radioList(ArrayHelper::map(Category::find()->where(['category_type' => 5])->all(), 'id', 'name'))->label('ผลดำเนินการ')?>
        <?=$form->field($model, 'data_json[result_date]')->widget(DateTimePicker::classname(), [
                'options' => ['placeholder' => 'เลือกวันเวลาดำเนินการเสร็จสิ้น ...'],
                'language' => 'th',
                'pluginOptions' => [
                    'autoclose' => true,
                ]
            ])->label('วันเวลาดำเนินการเสร็จสิ้น');
            ?>
    </div>
    <div class="col-6">
        <?php // $form->field($model, 'note')->widget(CKEditor::className(), ['editorOptions' => ElFinder::ckeditorOptions('elfinder')]) ?>

    </div>
</div>

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
    'pluginEvents' => [
        'fileuploaded' => "function (object,data){ 
            $('.field-goods-name').show().find('input').val(data.response.imageId);
        }",
        'filesuccessremove' => "function(event, id) {
            if (some_processing_function(id)) {
               console.log('Uploaded thumbnail successfully removed');
            } else {
                return false; // abort the thumbnail removal
            }
        }",
        'filezoomshow' => "function(event, params) {
            console.log('File zoom show ', params.sourceEvent, params.previewId, params.modal);
        }",
        "filesorted" => "function(event, params) {
            KeyShort(params)
            // console.log('File sorted ', params.previewId, params.oldIndex, params.newIndex, params.stack);
        }",
        //错误的冗余机制
        'error' => "function (){
            alert('图片上传失败');
        }"
    ]
]);
?>


<div class="form-group mt-3">
    <?=Html::submitButton('<i class="fas fa-check"></i> บันทึก', ['class' => 'btn btn-success'])?>
</div>

<?php ActiveForm::end();?>

<?php

$formUploadUrl = Url::to(['/soc/events/form-upload', 'id' => $model->id]);
$keyShortUrl = Url::to(['/uploads/key-short/']);
$js = <<< JS


function KeyShort(data){
    console.log(data);
    $.ajax({
        type: "post",
        url: "$keyShortUrl",
        data: data,
        dataType: "json",
        success: function (response) {
            console.log(response)
        }
    });
}
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
$this->registerJs($js, View::POS_END);
?>