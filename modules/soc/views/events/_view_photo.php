<?php
use yii\helpers\Html;
use kartik\widgets\FileInput;
use yii\helpers\Url;
use app\components\SystemHelper;

?>
<style>

    .file-caption{
        display: none;
    }
</style>
<section class="bg-light py-4 my-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="mb-3 text-primary">ภาพประกอบ</h2>
            </div>

            <?php foreach($model->uploads as $files):?>
    <?php
                $file_path = SystemHelper::getUploadPath() .$files->ref.'/'.$files->real_filename;
        // print_r($files);
        ?>
        <div class="col-md-6 col-lg-4">
            <div class="card my-3">
                <?=$files->show();?>
                <div class="card-body">
                    <!-- <h3 class="card-title"><a href="#" class="text-secondary">What is HTML</a></h3>
                    <p class="card-text">HTML stands for Hyper Text Markup Language, It helps to learn web development and designing. </p>
                    <a href="#" class="btn btn-primary">Read More</a> -->
                </div>
            </div>
        </div>
        <?php endforeach;?>
        
        
    </div>
    </div>
</section>


<?php
echo FileInput::widget([
    'name' => 'attachment_49[]',
    'options'=>[
        'multiple'=>true
    ],
    'pluginOptions' => [
            'showPreview' => true,
            'showCaption' => true,
            'showRemove' => false,
            'showUpload' => false,
        // 'initialPreview'=>[
        //     "https://upload.wikimedia.org/wikipedia/commons/thumb/e/e1/FullMoon2010.jpg/631px-FullMoon2010.jpg",
        //     "https://upload.wikimedia.org/wikipedia/commons/thumb/6/6f/Earth_Eastern_Hemisphere.jpg/600px-Earth_Eastern_Hemisphere.jpg"
        // ],
        'initialPreview'=> $initialPreview,
        'initialPreviewConfig'=> $initialPreviewConfig,
        'initialPreviewAsData'=>true,
        'initialCaption'=>"The Moon and the Earth",
        'initialPreviewConfig' => [
            ['caption' => 'Moon.jpg', 'size' => '873727'],
            ['caption' => 'Earth.jpg', 'size' => '1287883'],
        ],
        'overwriteInitial'=>false,
        'maxFileSize'=>2800
    ]
]);
?>