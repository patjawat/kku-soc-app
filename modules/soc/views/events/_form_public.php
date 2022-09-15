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
</style>
<?php
?>

<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-12">


            <?php $form = ActiveForm::begin(['id' => 'form-data']) ?>
            <?=$form->field($model, 'ref')->hiddenInput(['class' => 'ref'])->label(false); ?>

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
                </div>
            </div>


            <div class="info-box shadow-sm">
                <div class="info-box-content ">
                    <?= $form->field($model, 'person_type')->radioList(ArrayHelper::map(Category::find()->where(['category_type' => 1])->all(),'id','name')) ?>
                </div>
            </div>


            <div class="info-box shadow-sm">
                <div class="info-box-content ">
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

                </div>
            </div>

            <div class="info-box shadow-sm">
                <div class="info-box-content ">
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
                            'category_id' => 15
                        ],
                        'maxFileCount' => 1,
                        'minFileCount'=> 1,
                    ]
                ]);
    ?>
                        </div>
                    </div>
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
    success: function (response) {
       if(response){
           saveImage()
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


JS;
$this->registerJs($js);
?>