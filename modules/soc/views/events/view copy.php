<?php

use yii\helpers\Html;
use yii\web\View;
use yii\helpers\Url;
// use kartik\widgets\DetailView;
use kartik\detail\DetailView;
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
.table-bordered th {
    border: 1px solid #dee2e6;
    font-weight: 300;
}

.view-card-id {
    position: relative;
    width: 200px;
    height: 263px;
    max-height: 263px;

}

.view-card-id>img {
    position: absolute;
}

.file-preview-image {
    height: 238px;
    max-height: 238px;
}
</style>




<div class="container">
    <h1>Viewer with custom title</h1>
    <div id="galley">
      <ul class="pictures">
        <li><img data-original="../images/tibet-1.jpg" src="../images/thumbnails/tibet-1.jpg" alt="Cuo Na Lake"></li>
        <li><img data-original="../images/tibet-2.jpg" src="../images/thumbnails/tibet-2.jpg" alt="Tibetan Plateau"></li>
        <li><img data-original="../images/tibet-3.jpg" src="../images/thumbnails/tibet-3.jpg" alt="Jokhang Temple"></li>
        <li><img data-original="../images/tibet-4.jpg" src="../images/thumbnails/tibet-4.jpg" alt="Potala Palace 1"></li>
        <li><img data-original="../images/tibet-5.jpg" src="../images/thumbnails/tibet-5.jpg" alt="Potala Palace 2"></li>
        <li><img data-original="../images/tibet-6.jpg" src="../images/thumbnails/tibet-6.jpg" alt="Potala Palace 3"></li>
        <li><img data-original="../images/tibet-7.jpg" src="../images/thumbnails/tibet-7.jpg" alt="Lhasa River"></li>
        <li><img data-original="../images/tibet-8.jpg" src="../images/thumbnails/tibet-8.jpg" alt="Namtso 1"></li>
        <li><img data-original="../images/tibet-9.jpg" src="../images/thumbnails/tibet-9.jpg" alt="Namtso 2"></li>
      </ul>
    </div>
  </div>
  
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
                'value' => $model->location->name ? $model->location->name : ''
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
                'value' => $model->resultType->name ? $model->resultType->name : ''
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



<div class="row">



    <?php foreach($model->uploads as $file):?>
    <?php if($file->type != 15):?>

    <div class="col-md-3">
        <div class="card mb-4 box-shadow" id="images">
            <?php echo $file->viewFile()?>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                        <!-- <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button> -->
                    </div>
                    <!-- <small class="text-muted">9 mins</small> -->
                </div>
            </div>
        </div>
    </div>


    <?php endif;?>
    <?php endforeach;?>
</div>

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


  <script src="https://unpkg.com/jquery@3/dist/jquery.slim.min.js" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/bootstrap@4/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

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
      var galley = document.getElementById('images');
      var viewer = new Viewer(galley, {
        url: 'data-original',
        title: function (image) {
          return image.alt + ' (' + (this.index + 1) + '/' + this.length + ')';
        },
      });
    });

JS;
$this->registerJs($js,View::POS_END);
?>