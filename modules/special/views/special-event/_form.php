<?php

use yii\helpers\Html;
use yii\web\View;
use app\modules\usermanager\models\User;
use kartik\datecontrol\DateControl;
use kartik\select2\Select2;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use kartik\widgets\FileInput;
use sjaakp\locator\Locator;

/** @var yii\web\View $this */
/** @var app\modules\special\models\SpecialEvent $model */
/** @var yii\widgets\ActiveForm $form */
?>



<div class="container">
    <div class="row">
        <div class="col-md-8 offset-2">
            <div class="card mt-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <h5>Speech to Text in Javascript</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea name="" readonly id="textbox" rows="6" class="form-control">
                                </textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button id="start-btn" class="btn btn-success btn-block">Start</button>
                            <button id="create" class="btn btn-danger btn-block" style="display: none">End</button>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <p id="instration">Press Start Voice Recognition</p>
                            <a download="info.txt" id="downloadlink" style="display: none">Download</a>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="special-event-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=$form->field($model, 'ref')->hiddenInput(['class' => 'ref'])->label(false); ?>

    <?= $form->field($model, 'special_date')->textInput() ?>

    <?= $form->field($model, 'location')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'special_event_id')->textInput() ?>


    <?php 
        echo FileInput::widget([
    'name' => 'upload_ajax[]',
    'options' => ['multiple' => true, 'accept' => ['image/*', 'video/*']], //'accept' => 'image/*' หากต้องเฉพาะ image
    'pluginOptions' => [
        'overwriteInitial' => false,
        'initialPreviewShowDelete' => true,
        'initialPreview' => $initialPreview,
        'initialPreviewConfig' => $initialPreviewConfig,
        'uploadUrl' => Url::to(['/uploads/upload-ajax']),
        'uploadExtraData' => [
            'ref' => $model->ref,
            'category_id' => 16,
        ],
        'maxFileCount' => 100,
    ],
]);
?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$js = <<< JS

var SpeechRecogntion = window.webkitSpeechRecognition;

var recognition = new window.SpeechRecogntion();

var textbox = $('#textbox');

var instration = $('#instration');

var content = '';

recognition.continuous = true

recognition.onstart = function (){
    instration.text('Voice Recognition is on')
}

recognition.onspeechend = function (){
    instration.text('No Activity');
}

recognition.onerror = function (event){
    instration.text('Try Again');
    console.log(event);
}

recognition.onresult = function(event) {
    var current = event.resultIndex;
    var transcript = event.results[current][0].transcript;
    var confidence = event.results[current][0].confidence;
    console.log(transcript);
     content += transcript;
    $('#textbox').val(content);
};
              

$('#start-btn').click(function(event) {
    if(content.length){
        content += ''
    }
    $('#textbox').val('welcome to nicesnippets.com');
    $('#downloadlink').css('display','none');
    $('#create').css('display','block');
    $(this).css('display','none');
    recognition.start()
});

 
var textFile = null,  
makeTextFile = function (text) {  
var data = new Blob([text], {type: 'text/plain'});  

// If we are replacing a previously generated file we need to  
// manually revoke the object URL to avoid memory leaks.  
if (textFile !== null) {  
  window.URL.revokeObjectURL(textFile);  
}  

textFile = window.URL.createObjectURL(data);  

return textFile;  
};  


var create = document.getElementById('create'),  
textbox = document.getElementById('textbox');  

create.addEventListener('click', function () {  
    var link = document.getElementById('downloadlink');  
    link.href = makeTextFile(textbox.value);  
    link.style.display = 'block';  
    $('#start-btn').css('display','block');
    $('#create').css('display','none');
    recognition.stop()
    content = '';
    $('#instration').text('Press Start Voice Recognition');
}, false);  

JS;
$this->registerJs($js,View::POS_END)
?>