<?php

use yii\helpers\Html;
use yii\web\View;
use yii\helpers\Url;
use yii\widgets\DetailView;
// use kartik\detail\DetailView;
use edofre\markerclusterer\Map;
use edofre\markerclusterer\Marker;
use app\components\SystemHelper;
use dominus77\sweetalert2\assets\ThemeAsset;
use app\components\UserHelper;

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
  <style>
    .pictures {
      list-style: none;
      margin: 0;
      max-width: 30rem;
      padding: 0;
    }

    .pictures > li {
      border: 1px solid transparent;
      float: left;
      height: calc(100% / 3);
      margin: 0 -1px -1px 0;
      overflow: hidden;
      width: calc(100% / 3);
    }

    .pictures > li > img {
      cursor: zoom-in;
      width: 100%;
    }
  </style>


  <div class="row">
  <div class="col-auto mr-auto">
  <p>
    <?= $model->reporter == '' ? Html::a('<i class="far fa-edit"></i> รับเรื่อง', ['confirm-job', 'id' => $model->id], ['class' => 'btn btn-info','id' => 'confirm-job']):'' ?>
    <?= $model->reporter == '' ? null : Html::a('<i class="far fa-edit"></i> แก้ไข', ['update', 'id' => $model->id], ['class' => 'btn btn-warning showปป']) ?>
    <?= Html::a('<i class="fas fa-trash"></i> ลบทิ้ง', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
</p>

  </div>
  <div class="col-auto">
    <?=Html::a('<i class="far fa-arrow-alt-circle-down"></i> Download',['/soc/default/zip','ref' => $model->ref],['class' => 'btn btn-success','id' => 'download'])?>
    <!-- <button type="button" class="btn btn-success" onclick="return "><i class="far fa-arrow-alt-circle-down"></i> Download File</button> -->
  </div>
</div>



<?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'วันเวลาแจ้ง',
                'value' => $model->created_at
            ],
            'fullname',
            'phone',
          
            [  
                'label' => 'ประเภทบุคคล',
                'value' => $model->personType ? $model->personType->name : ''
            ],
            [
                'attribute' => 'event_type',
                'value' => $model->eventType ? $model->eventType->name : ''
            ],
            'department',
            [
                'attribute' => 'event_location_note',
                'format' => 'raw',
                'value' => function ($model) {

                  if($model->event_location_note == 97){
                    return ($model->location ? $model->location->name : '').'... &nbsp;(<code>&nbsp;'.$model->data_json['location_other'].'&nbsp;</code>)';
                  }else{
                    return ($model->location ? $model->location->name : '').$model->event_location_note;
                  }
                  // return $model->event_location_note;
                }
            ],
            
            'orther',
            // [
            //     'lable' => 'ผู้ร่วมปฏิบัติงาน',
            //     'value' => $model->ref,
            // ],
            'note',
            'backup_to',
            [
                'attribute' => 'result',
                'value' => $model->resultType ? $model->resultType->name : ''
            ],
            [
                'label' => 'สำเนาบัตรประจำตัวนักศึกษา/สำเนาบัตรประจำตัวประชาชน/สำเนาบัตรข้าราชการ',
                'format' => 'raw',
                'value' => $model->getIdCart()
            ],
            [
                'label' => 'ลายเซ็นต์',
                'format' => 'raw',
                'value' => Html::img('@web/signature/'.$model->ref.'.jpg',['style' => 'width:50%'])
            ]
           
            
        ],
    ]) ?>



<div class="row" id="galley">



    <?php foreach($model->uploads as $file):?>
    <?php  if($file->type != 15):?>
    <div class="col-md-3">
        <div class="card mb-4 box-shadow">
            <?php echo $file->viewFile()?>
            
        </div>
    </div>


    <?php  endif;?>
    <?php endforeach;?>
</div>


<?php
$ConfirmUrl = Url::to(['/soc/events/confirm-job']);
$userConfirm = UserHelper::getUser('fullname');
$id = $model->id;
$js = <<< JS
$('#confirm-job').click(function (e) { 
    e.preventDefault();
     
Swal.fire({
  title: 'ผู้รับรายงานเหตุ?',
  text: "$userConfirm!",
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
  }
})
    
});




window.addEventListener('DOMContentLoaded', function () {
      var galley = document.getElementById('galley');
      var viewer = new Viewer(galley, {
        url: 'src',
        title: function (image) {
          console.log(image)
          return image.alt + ' (' + (this.index + 1) + '/' + this.length + ')';
        },
      });
    });





$('#download').click(function (e) { 
    e.preventDefault();
    var url = $(this).attr('href');
    $.ajax({
        type: "get",
        url: url,
        dataType: "json",
        success: function (response) {
            console.log(response)
        }
    });
});

JS;
$this->registerJs($js,View::POS_END);
?>