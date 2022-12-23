<?php
use yii\helpers\Html;
use yii\web\View;
?>
<table class="table table-striped">
    <thead>
        <tr>
            <th style="width: 10px">#</th>
            <th>Reader</th>
            <th>ผลเบื้องต้น</th>
            <th>วันที่เข้า ก.พ.ว.</th>
            <th>วันที่ Readers ต้องส่งผล</th>
            <th>วันที่ Readers ส่งผลกลับ</th>
            <!-- <th style="width: 40px">Label</th> -->
            <th style="width: 100px">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($dataProvider->getModels() as $model):?>
        <tr>
            <td>1.</td>
            <td><?=$model->reader->fullname;?></td>
            <td>
                <?php if($model->checkup == 1):?>
                    <i class="fas fa-check text-success"></i> ผ่าน
                    <?php else:?>
                        <i class="fas fa-times text-danger"></i> ไม่ผ่าน
                        <?php endif;?>
            </td>
            <td><?=Yii::$app->formatter->asDate($model->checkup,'php:d/m/yy');?></td>
            <td><?=Yii::$app->formatter->asDate($model->reader_fix_date,'php:d/m/yy');?></td>
            <td><?=Yii::$app->formatter->asDate($model->reader_result_date,'php:d/m/yy');?></td>

            <!-- <td>
                <div class="progress progress-xs">
                    <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                </div>
            </td> -->
            <!-- <td><span class="badge bg-danger">55%</span></td> -->
            <td>
            <?= Html::a('<i class="far fa-edit"></i>', ['update', 'id' => $model->id], ['class' => 'btn btn-sm btn-warning a-modal']) ?>
            <?= Html::a('<i class="far fa-edit"></i>', ['delete', 'id' => $model->id], ['class' => 'btn btn-sm btn-danger a-modal']) ?>

            </td>
        </tr>
       <?php endforeach;?>
    </tbody>
</table>

<?php
$js = <<< JS


$('.a-modal').click(function (e) { 
    e.preventDefault();
    var url = $(this).attr('href');

    $.ajax({
        type: "get",
        url: url,
        dataType: "json",
        success: function (response) {
            $('#main-modal').modal('show');
           $('#main-modal-label').html(response.title);
            $('.modal-body').html(response.content);
            $('.modal-footer').html(response.footer);
            $(".modal-dialog").removeClass('modal-sm');
            $(".modal-dialog").addClass('modal-lg');
            $('.modal-content').addClass('card-outline card-primary');
        }
    });
    
});

JS;
$this->registerJS($js,View::POS_END);
?>