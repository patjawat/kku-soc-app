<?php
use app\modules\soc\models\Events;
$sql = "SELECT *,(SELECT COUNT(events.id) FROM events WHERE events.event_type = category.id)  as total_item,
(SELECT COUNT(events.id) FROM events) as total,
((SELECT COUNT(events.id) FROM events WHERE events.event_type = category.id) * 100  / (SELECT COUNT(events.id) FROM events)) as item_percen
        FROM `category`
        WHERE category.category_type = 2
        ORDER BY total_item DESC;";
         $querys = Yii::$app->db->createCommand($sql)
         ->queryAll();
         
        
?>
<div class="card shadow">
    
    <div class="card-header">
        สถิติการขอดูภาพจกากกล้องวงจรปิด <?=$querys[0]['total']?> ครั้ง
    </div>
    
    <div class="card-body">


        <?php foreach ($querys as $key => $model):?>
        <?php
                    switch ($key) {
                        case 0:
                            $color = "danger";
                            break;
                        
                        case 1:
                                $color = "warning";
                                break;
                        case 2:
                                $color = "primary";
                                break;
                        case 3:
                                $color = "info";
                                break;
                        default:
                            $color = "success";
                            break;
                     }
                    ?>
        <div class="progress-group">
            <?=$model['name'];?>
            <?php
            // $result = $model->countPercen();
            ?>
            <span class="float-right"><b><?=$model['total_item']?> ครั้ง</b></span>
            <div class="progress">
                <div class="progress-bar progress-bar-striped bg-<?=$color?>" style="width: <?=$model['item_percen']?>%"></div>
            </div>
        </div>
        <?php endforeach;?>
    </div>
</div>