<?php
use app\models\Category;

$summnarys = Category::find()->where([
    'category_type' => '2'
])->all(); 
?>

<p class="text-center">รายงานสรุปผลการดำเนินการสถิติผู้ขอความอนุเคราะห์ดูภาพเหตุการณ์</p>
<p class="text-center">จากศูนย์ปฏิบัติการรักษาความปลอดภัยทางกายภาพ</p>
<p class="text-center">ประจำเดือนตุลาคม 2565 ระหว่าง <?=Yii::$app->formatter->asDate($date1, 'php:Y-m-d')?> –
    <?=Yii::$app->formatter->asDate($date2, 'php:Y-m-d')?></p>

<?php
// print_r($dataProvider->getModels());
?>

<table class="table table-bordered">
    <thead>
        <tr>
            <th class="align-middle" scope="col">ลำดับ</th>
            <th scope="col">ว/ด/ป</th>
            <th scope="col">เรื่อง/เหตุการณ์</th>
            <th style="text-align:center" scope="col">ระยะเวลา</th>
            <th style="text-align:center" scope="col">ผลการดำเนินการ</th>
            <th style="text-align:center" scope="col">ประเภทผู้ขอความอนุเคราะห์</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1;?>
        <?php foreach ($dataProvider->getModels() as $model): ?>
        <tr>
            <th style="text-align:center" scope="row"><?=$i++;?></th>
            <td><?=Yii::$app->formatter->asDate($model->created_at, 'php:Y-m-d')?></td>
            <td><?=$model->eventType->name;?></td>
            <td style="text-align:center">-</td>
            <td style="text-align:center"><?=isset($model->resultType) ? $model->resultType->name : '-';?></td>
            <td style="text-align:center"><?=isset($model->personType) ? $model->personType->name : '-';?></td>
        </tr>
        <?php endforeach;?>
       

    </tbody>
</table>

<table class="table">
    <thead>
        <tr>
            <th style="text-align:center" colspan="2">สรุปจำนวนผู้ขอความอนุเคราะห์</th>
        </tr>
        </thead>
<tbody>
<?php foreach($summnarys  as $summnary ):?>
    
        <tr>
            <th ><?=$summnary->name?></th>
            <td style="text-align:center">8</td>
        </tr>
 <?php endforeach;?>
 </tbody>
</table>