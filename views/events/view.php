<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\overlays\InfoWindow;
use edofre\markerclusterer\Map;
use edofre\markerclusterer\Marker;
use app\components\SystemHelper;


/* @var $this yii\web\View */
/* @var $model app\models\Events */

$this->title = 'แสดงรายละเอียเเหตุการณ์';
$this->params['breadcrumbs'][] = ['label' => 'Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);


// use buttflattery\videowall\Videowall;
// echo Videowall::widget([
//     'videoTagOptions' => [
//         'height' => "500",
//     ],
//     'wallType' => Videowall::TYPE_CAROUSEL,
//     'videos' => [
//         [
//             "src" => "/PATH/TO/VIDEO.MP4",
//             "mime" => 'video/mime',
//             "poster" => "/PATH/TO/POSTER.JPG",
//             "title" => "Sweet Sexy Savage",
//         ], [
//             "src" => '/PATH/TO/VIDEO.MP4',
//             'poster' => '/PATH/TO/POSTER.JPG',
//             'mime' => 'video/mime',
//             'title' => 'Video 2',
//         ],
//     ]
// ]);


?>
xxx

<img src="<?= Yii::$app->request->baseUrl ?>/../var/files/XSC0WeoLbMMF13KwJH_AnY/9c750a9bf5751bcbe97b2b4ba2685e08.png">

<?php foreach($model->uploads as $files):?>
    <?php
                $file_path = SystemHelper::getUploadPath() . $files->real_filename;
        
        ?>
<img loading="lazy" src="image?file_path=<?php echo $file_path ?>" alt="Image" class="img-responsive"/>
<!-- <img loading="lazy" src="http://127.0.0.1:81/uploads/image?file_path=/app/var/files/9c750a9bf5751bcbe97b2b4ba2685e08.png" alt="Image" class="img-responsive"/> -->
<?php endforeach;?>
<div class="panel panel-default">
  <div class="panel-body">
     <?= dosamigos\gallery\Gallery::widget(['items' => $model->getThumbnails($model->ref,$model->ref)]);?>
  </div>
</div>
xxx

<div class="events-view">
    <p>
    <?= Html::a('<i class="far fa-edit"></i> แก้ไข', ['update', 'id' => $model->id], ['class' => 'btn btn-warning showปป']) ?>
        <?= Html::a('<i class="fas fa-trash"></i> ลบทิ้ง', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?=$this->render('map', [
            'markers' => $markers
        ]);?>

<div class="card card-success shadow-sm mt-3">
<div class="card-header">
<h3 class="card-title">รายละเอียดเหตุการ์</h3>
<div class="card-tools">
<button type="button" class="btn btn-tool" data-card-widget="collapse">
<i class="fas fa-minus"></i>
</button>
</div>

</div>



<div class="card-body">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'fullname',
            'person_type',
            'department',
            'address',
            'phone',
            'event_date',
            'event_type',
            'orther',
        ],
    ]) ?>

</div>

</div>


</div>

