<?php
use app\components\SystemHelper;

use app\models\Uploads;

use buttflattery\videowall\Videowall;

$id = 21;
// $path = 'file.mp4';
$model = Uploads::find()->where(['upload_id' => $id])->One();
$path = SystemHelper::getUploadPath(). $model->ref.'/'.$model->real_filename;

echo Videowall::widget([
    'videoTagOptions' => [
        'height' => "500",
    ],
    'wallType' => Videowall::TYPE_CAROUSEL,
    'videos' => [
        [
            "src" => $path,
            "mime" => 'video/mime',
            // "poster" => "/PATH/TO/POSTER.JPG",
            "title" => "Sweet Sexy Savage",
        ]
    ]
]);
?>