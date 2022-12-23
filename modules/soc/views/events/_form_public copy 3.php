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
    <div class="card p-3">
        <div class="row justify-content-md-center">
            <div class="col-12">


                <?php $form = ActiveForm::begin(['id' => 'form-data']) ?>
                <?=$form->field($model, 'ref')->hiddenInput(['class' => 'ref'])->label(false); ?>

                <div class="form-group">
                    <?= Html::submitButton('<i class="fas fa-check"></i> บันทึก', ['class' => 'btn btn-block btn-success']) ?>
                </div>

                <?php ActiveForm::end(); ?>


            </div>
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

var w = 924;

var h = 300;
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