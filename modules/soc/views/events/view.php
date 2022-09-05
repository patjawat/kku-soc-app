<?php

use yii\helpers\Html;
use yii\web\View;
use yii\helpers\Url;
use yii\widgets\DetailView;
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\overlays\InfoWindow;
use edofre\markerclusterer\Map;
use edofre\markerclusterer\Marker;
use app\components\SystemHelper;
use dominus77\sweetalert2\assets\ThemeAsset;

/** @var yii\web\View $this */

// ThemeAsset::register($this, ThemeAsset::THEME_DARK);
ThemeAsset::register($this);

/* @var $this yii\web\View */
/* @var $model app\models\Events */

$this->title = $model->reporter == ''? 'ยังไม่ได้รับเรื่อง' : 'ผู้รับเรื่อง : '.$model->getUser();
$this->params['breadcrumbs'][] = ['label' => 'Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

?>


    <p>
    <?= $model->reporter == '' ? Html::a('<i class="far fa-edit"></i> รับเรื่อง', ['confirm-job', 'id' => $model->id], ['class' => 'btn btn-info','id' => 'confirm-job']):'' ?>
    <?= Html::a('<i class="far fa-edit"></i> แก้ไข', ['update', 'id' => $model->id], ['class' => 'btn btn-warning showปป']) ?>
        <?= Html::a('<i class="fas fa-trash"></i> ลบทิ้ง', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php $this->render('map', [
            'markers' => $markers
        ]);?>

<div class="alert alert-info" role="alert">
        <strong><i class="far fa-edit"></i> ข้อมูลพื้นฐาน</strong>
    </div>



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'fullname',
            [  
                'label' => 'เหตุการณ์',
                'value' => $model->eventType ? $model->eventType->name : ''
            ],
            'phone',
            'department',
            [  
                'label' => 'ประเภทบุคคล',
                'value' => $model->personType ? $model->personType->name : ''
            ],
            'address'
        ],
    ]) ?>

<div class="alert alert-info" role="alert">
        <strong><i class="far fa-edit"></i> รายละเอียดเหตุการ์</strong>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'event_date',
            'event_location_note',
            'orther',
            'work_img',
            'docs',
        ],
    ]) ?>



    <div class="alert alert-info" role="alert">
    <strong><i class="far fa-edit"></i> สรุปผล</strong>
</div>
<?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'reporter',
            'result',
            'backup_to',
            'note',
        ],
    ]) ?>


<div class="alert alert-info" role="alert">
    <strong><i class="far fa-edit"></i> รูปภาพ/วีดีโอ</strong>
</div>

<?php foreach($model->uploads as $files):?>
<p><?php // print_r($files)?></p>
<?php endforeach;?>

<?php
$ConfirmUrl = Url::to(['/soc/events/confirm-job']);
$id = $model->id;
$js = <<< JS
$('#confirm-job').click(function (e) { 
    e.preventDefault();
     
Swal.fire({
  title: 'ผู้รับรายงานเหตุ?',
  text: "นายปัจวัฒน์ ศรีบุญเรือง!",
  icon: 'warning',
  showCancelButton: true,
//   confirmButtonColor: '#3085d6',
//   cancelButtonColor: '#d33',
  confirmButtonText: 'ใช่,ยืนยัน!',
  cancelButtonText: 'ยกเลิก'
}).then((result) => {
  if (result.isConfirmed) {
    $.ajax({
        type: "get",
        url: "$ConfirmUrl",
        data:{id:$id},
        dataType: "json",
        success: function (response) {
            console.log(response)
        }
    });
    // Swal.fire(
    //   'Deleted!',
    //   'Your file has been deleted.',
    //   'success'
    // )
  }
})
    
});
JS;
$this->registerJs($js,View::POS_END);
?>