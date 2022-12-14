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

.view-cid{
    position: relative;
    /* height: 237px; */
}
.view-cid > img {
    position: absolute;
    margin-top: -78px;
    margin-left: 0;
    margin-right: 0;
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

        <?=$form->field($model, 'event_date')->widget(DateControl::classname(), $optiondate)->label('วันเวลาเกิดเหตุ')?>
        <?=$form->field($model, 'event_location_note')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(Category::find()->where(['category_type' => 4])->all(), 'id', 'name'),
    'options' => ['placeholder' => 'เลือก' . $model->getAttributeLabel('event_location_note') . '...', 'multiple' => false],
])->label(true);
?>
<?=$form->field($model, 'orther')->textArea()?>

    </div>
    <div class="col-4">

        <div class="alert alert-info" role="alert">
            <strong><i class="far fa-edit"></i> บัตรประชาชน/บัตรนักศึกษา</strong>
            <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button> -->
  <span class="btn btn-primary" id="cidSelect">เลือกไฟล์บัตรประชาชน</span>
        </div>
        <div class="view-cid">
            <?=$model->getIdCart()?>
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
<?php echo $form->field($model, 'note')->textarea(['rows' => 5])->label(true) ?>
<?=$form->field($model, 'backup_to')->textInput()?>
<?=$form->field($model, 'result')->inline()->radioList(ArrayHelper::map(Category::find()->where(['category_type' => 5])->all(), 'id', 'name'))->label('ผลดำเนินการ')?>
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
]);
?>


        <div class="form-group">
            <?=Html::submitButton('<i class="fas fa-check"></i> บันทึก', ['class' => 'btn btn-success'])?>
        </div>

        <?php ActiveForm::end();?>

        <?php

$formUploadUrl = Url::to(['/soc/events/form-upload', 'id' => $model->id]);
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
$this->registerJs($js, View::POS_END);
?>