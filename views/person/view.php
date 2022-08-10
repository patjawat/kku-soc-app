<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
// use dominus77\sweetalert2\Alert;

/* @var $this yii\web\View */
/* @var $model app\models\Person */

$this->title = $model->Fullname().' |  '.($model->org->name).'  | ผู้รับผิดชอบ ( <i class="fas fa-user-tag"></i> <span class="text-danger"> นายปัจวัฒน์ ศรีบุญเรือง </span>)';
$this->params['breadcrumbs'][] = ['label' => 'People', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<?php

// Alert::widget([
//     'options' => [
//         'Good job!',
//         'You clicked the button!',
//         Alert::TYPE_SUCCESS
//     ]
// ])
 ?>
<style>
    .table thead th {
    font-weight: 300 !important;
}
.alert-primary {
    color: #004085 !important;
    background-color: #cce5ff !important;
    border-color: #b8daff !important;
}
</style>
<div class="person-view">

    <p>
    <?= Html::a('<i class="fas fa-plus"></i> เพิ่มใหม่', ['/tracking/create', 'id' => $model->id], ['class' => 'btn btn-success show']) ?>

        <?= Html::a('<i class="far fa-edit"></i> แก้ไข', ['update', 'id' => $model->id], ['class' => 'btn btn-warning show']) ?>
        <?= Html::a('<i class="fas fa-trash"></i> ลบทิ้ง', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php  DetailView::widget([
        'model' => $model,
        'attributes' => [

            [
                'label' =>'ตำแหน่ง',
                'value' => function ($model){
                    return $model->position ? $model->position->name : '';
                }
            ],
            [
                'label' =>'สาขาวิชา',
                'value' => function ($model){
                    return $model->studyname ?  $model->studyname->name : '-';
                }
            ],
            'author',
            'note:ntext',

        ],
    ]) ?>

</div>

<?php $i = 1;?>
<?php  foreach($model->tracking  as $tracking):?>
<div class="alert alert-primary" role="alert">
  ขอยื่นครั้งที่ <?=$i++;?> 
  <?= Html::a('<i class="far fa-edit"></i> แก้ไข', ['/tracking/update', 'id' => $tracking->id], ['class' => 'btn btn-warning btn-sm show text-back']) ?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
</button>
</div>
<div class="container mb-3">
<?php Html::a('Delete', ['/tracking/delete', 'id' => $tracking->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>


    <p>สถานะการขอยื่น : <?=$tracking->status_id;?></p>
    <p>วันที่สภาอนุมัติ : <?=$tracking->status_id;?></p>
    <p>โปรดเกล้าแต่งตั้งให้ดำรงต่ำแหน่ง : <?=$tracking->status_id;?></p>
    <p>วันที่ต้องติดตามผล : <?=$tracking->status_id;?></p>
</div>
<?php endforeach; ?>

<?php 
// $js = <<< JS

// $('.show').click(function (e) { 
//     e.preventDefault();
//     $.ajax({
//         type: "get",
//         url: $(this).attr('href'),
//         dataType: "json",
//         beforeSend: function() {
//             beforLoadModal();
//         },
//         success: function (res) {
//             console.log(res);
//             $(".modal-dialog").removeClass('modal-sm modal-md modal-lg');
//             $(".modal-dialog").addClass('modal-lg');
//             $('#main-modal').removeClass('fade');
//             $('#main-modal').modal('show');
//             $('#main-modal-label').html(res.title);
//             $('.modal-body').html(res.content);
//             $('.modal-footer').html(res.footer);
//         }
//     });
    
// });

// JS;
// $this->registerJS($js);
?>