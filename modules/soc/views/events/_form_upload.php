<?php 
use yii\helpers\Url;
use kartik\widgets\FileInput;
use app\components\SystemHelper;

$init = SystemHelper::dataSession();

        echo FileInput::widget([
    'name' => 'upload_ajax[]',
    'options' => ['multiple' => true, 'accept' => ['image/*', 'video/*']], //'accept' => 'image/*' หากต้องเฉพาะ image
    'pluginOptions' => [
        'overwriteInitial' => false,
        'initialPreviewShowDelete' => true,
        'initialPreview' => $initialPreview,
        'initialPreviewConfig' => $initialPreviewConfig,
        'uploadUrl' => Url::to(['/soc/events/upload-ajax']),
        'uploadExtraData' => [
            'ref' => $model->ref,
            'category_id' => 15
        ],
        'maxFileCount' => 1,
        
    ],
    'pluginEvents' => [
        "fileimagesloaded" => "function() { 
            console.log('fileimagesloaded'); 
         }",
        "filereset" => "function() { 
            console.log('filereset');
            //$('#main-modal').modal('toggle');

        }",
        "filechunksuccess" => "function() { 
            console.log('filechunksuccess'); 
        }",
        "filebatchuploadcomplete" => "function() { 
            console.log('Upload File สำเร็จ'); 
            $('#main-modal').modal('toggle');
           window.location.reload();
         }",
    //    "filebeforedelete" => "function() { loadEmrDocumentQR(); }",
       "filepreupload" => "function() { 
        console.log('กำลัง Upload File'); 

        }",
        "fileremoved" => "function(){
            console.log('fileremoved'); 
        }"
    ]
]);
?>