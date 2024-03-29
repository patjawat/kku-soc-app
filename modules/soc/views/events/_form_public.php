<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\DateTimePicker;
use kartik\datecontrol\DateControl;
use kartik\widgets\Select2;
use kartik\widgets\FileInput;
use buttflattery\formwizard\FormWizard;
use yii\web\View;

use app\models\Category;
$this->title = 'ลงทะเบียน';

$optiondate = ['type' => DateControl::FORMAT_DATETIME,'language' => 'th',];
$this->registerJsFile('@web/js-signature/modernizr.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<style type="text/css">
#signature-pad {
    border: solid 1px blue;
}

#signature-pad {
    min-height: 20px;
    border: 1px solid #000;
}

#signature-pad canvas {
    position: absolute;
    left: 0;
    top: 0;
}
</style>

<style>
label:not(.form-check-label):not(.custom-file-label) {
    font-weight: 400 !important;
}

.alert-primary {
    color: #004085;
    background-color: #cce5ff;
    border-color: #b8daff;
}

.alert-info {
    color: #0c5460;
    background-color: #d1ecf1;
    border-color: #bee5eb;
}

.form-control {
    display: block;
    font-family: Prompt;
    width: 100%;
    height: calc(4.25rem + 2px);
    /* height: 73px; */
    padding: 0.375rem 0.75rem;
    font-size: 1.5rem;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    background-color: #ececec;
    background-clip: padding-box;
    border: none;
    border-radius: 0.25rem;
    box-shadow: none;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}
.form-control:focus{
    background-color: #dee2e6;
    transition: 0.3s;

}

label:not(.form-check-label):not(.custom-file-label) {
    font-weight: 400 !important;
    font-size: 1.5rem;
    font-family: Prompt;
}

.file-caption-name{
    font-size: 22px;
    height: 38px;
}
</style>
<?php
?>


<div class="loading text-center text-light mt-5" style="display:none;" >
<i class="fas fa-spinner fa-spin fa-3x fa-fw margin-bottom"></i>
<h1 class="text-center">รอสักครู่...</h1>
</div>

<div class="container container-form">
    <div class="row justify-content-md-center">
        <div class="col-12">


            <?php $form = ActiveForm::begin(['id' => 'form-data']) ?>
            <?=$form->field($model, 'ref')->hiddenInput(['class' => 'ref'])->label(false); ?>
            <div class="alert alert-info" role="alert">
    <strong><i class="far fa-edit"></i> บันทึกขอใช้บริการ </strong>
</div>



            <div class="info-box shadow-sm">
                <div class="info-box-content ">
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <?= $form->field($model, 'fname')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <?= $form->field($model, 'lname')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>

                    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

                    <!-- <label class="control-label" for="upload_files[]"> สำเนาบัตรประจำตัวนักศึกษา/สำเนาบัตรประจำตัวประชาชน/สำเนาบัตรข้าราชการ </label> -->
                        <div>
                            <?php   FileInput::widget([
                                    'name' => 'upload_ajax[]',
                                    'options' => ['multiple' => true,'accept' => ['image/*']], //'accept' => 'image/*' หากต้องเฉพาะ image
                                        'pluginOptions' => [
                                            'overwriteInitial'=>true,
                                            'initialPreviewShowDelete'=>true,
                                            'initialPreview'=> $initialPreview,
                                            'initialPreviewConfig'=> $initialPreviewConfig,
                                            'uploadUrl' => Url::to(['/soc/events/upload-ajax']),
                                            'uploadExtraData' => [
                                                'ref' => $model->ref,
                                                'category_id' => 15
                                            ],
                                            // 'maxFileCount' => 1,
                                            // 'minFileCount'=> 1,
                                        ]
                                        ]);
                            ?>
                        </div>

                </div>
            </div>


            <div class="info-box shadow-sm">
                <div class="info-box-content">
            <!-- <label class="control-label" for="upload_files[]"> เอกสารอื่นๆหรือหลักฐานที่เกี่ยวข้อง เช่น ใบบันทึกแจ้งความ </label> -->
                        <div>
                            <?php  FileInput::widget([
                                    'name' => 'upload_ajax[]',
                                    'options' => ['multiple' => true,'accept' => ['image/*']], //'accept' => 'image/*' หากต้องเฉพาะ image
                                        'pluginOptions' => [
                                            'overwriteInitial'=>true,
                                            'initialPreviewShowDelete'=>true,
                                            'initialPreview'=> $initialPreview,
                                            'initialPreviewConfig'=> $initialPreviewConfig,
                                            'uploadUrl' => Url::to(['/soc/events/upload-ajax']),
                                            'uploadExtraData' => [
                                                'ref' => $model->ref,
                                                'category_id' => 16
                                            ],
                                            // 'maxFileCount' => 1,
                                            // 'minFileCount'=> 1,
                                        ]
                                        ]);
                            ?>
                        </div>
                        </div>
                        </div>


                        
            <div class="info-box shadow-sm">
                <div class="info-box-content ">
                    <?= $form->field($model, 'person_type')->radioList(ArrayHelper::map(Category::find()->where(['category_type' => 1])->all(),'id','name')) ?>
                </div>
            </div>
            
            
            <div class="info-box shadow-sm">
                <div class="info-box-content">
                    <?= $form->field($model, 'department')->textInput(['maxlength' => true]) ?>
                    
                </div>
            </div>

            <div class="alert alert-info" role="alert">
    <i class="far fa-edit"></i>  บรรยายเหตุการณ์
</div>
            <div class="info-box shadow-sm">
                <div class="info-box-content ">

                    
                <?php //  $form->field($model, 'event_date')->widget(DateControl::classname(), $optiondate)->label(true)?>
<?php
echo $form->field($model, 'event_date')->widget(DateTimePicker::classname(), [
    'options' => ['placeholder' => 'เลือกวันเวลาที่เกิดเหตุ ...'],
    'language' => 'th',
    'pluginOptions' => [
        'autoclose' => true
    ]
]);
?>
<?php 
echo $form->field($model, 'event_type')->widget(Select2::classname(), [
'data' =>  ArrayHelper::map(Category::find()->where(['category_type' => 2])->all(),'id','name'),
'options' => ['placeholder' => 'เลือกเหตุการณ์'],
'pluginOptions' => [
'allowClear' => true,
],

]);
?>
<?=$form->field($model, 'orther')->textArea()->label('บรรยายเหตุการณ์')?>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <i class="fas fa-user-lock"></i> PDPA
                </div>
                <div class="card-body">
                    <?php
    echo $form->field($model, 'accept_pdpa', 
    ['options' => ['tag' => 'span'], 
    'template' => "{input}"]
)
->checkbox(['checked' => false, 'required' => true]);
    ?>
                </div>
            </div>


            <div class="wrapper-draw" style="background-color:#dee2e6;">
        <canvas id="signature-pad" class="signature-pad"></canvas>
    </div>

    <button id="clear" class="btn btn-block btn-danger">เซ็นต์ใหม่</button>

            <div class="form-group">
                <?= Html::submitButton('<i class="fas fa-check"></i> บันทึก', ['class' => 'btn btn-block btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>


        </div>



    </div>
</div>

<?php

$imgOri = Url::to('@web/images/bg-w.png');

if($model->isNewRecord){
    $img = $imgOri;
}else{
    $img = $img = Url::to('@web/signature/'.$model->ref.'.jpg');
}

$js = <<< JS
var cancelButton = document.getElementById('clear');
cancelButton.addEventListener('click', function (event) {
  signaturePad.clear();
});

var w = 300;

var h = 200;
$('#signature-pad').width(w)

var clearButton = $('#clear');

const canvas = document.querySelector("#signature-pad");

const signaturePad = new SignaturePad(canvas, {
  backgroundColor: 'rgb(255, 255, 255)'
}) 
canvas.width = w;
canvas.height = h;


ctx = canvas.getContext("2d");

// // only load the image once
const img = new Promise(r => {
  const img = new Image();
  img.src = '$img';
  img.onload = () => {
    ctx.drawImage(img, 0, 0,w,h);
  };
});

clearButton.click(function(){
    signaturePad.clear();
    const img = new Image();
  img.src = '$imgOri';
  img.onload = () => {
    ctx.drawImage(img, 0, 0,w,h);
  };
});



$("#form-data").on('beforeSubmit', function (e) {
var form = $(this);
  e.preventDefault(); // stopping submitting

$.ajax({
    type:form.attr('method'),
    url: form.attr('action'),
    data:form.serialize(),
    dataType: "json",
    beforeSend: async function() {
        await $('.container-form').hide();
        await $('.loading').show();
      },
    success: function (response) {
       if(response){
           saveImage()
           endJob()
       }
    }
});
return false;

});

function saveImage(){
    const dataURL = signaturePad.toDataURL("image/jpeg")

$.ajax({
    type: "post",
    url: "save-image",
    data:{
        image:dataURL,
        ref:$('.ref').val()
    },
    dataType: "json",
    success: function (response) {
       
        console.log(response)
    }
});
}


function endJob() {
    
    $('.loading > h1').html('บันทึกสำเร็จ');
    $('.loading > i').hide();

    Swal.fire(
        'บันทึกสำเร็จ!',
        'You clicked the button!',
        'success'
        )

 }



JS;
$this->registerJs($js,View::POS_END);
?>