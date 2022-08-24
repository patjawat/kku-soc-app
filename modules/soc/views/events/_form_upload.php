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
        'uploadUrl' => Url::to(['/uploads/upload-ajax']),
        'uploadExtraData' => [
            'ref' => $init['ref'],
            'category_id' => 16,
        ],
        'maxFileCount' => 100,
    ],
]);
?>