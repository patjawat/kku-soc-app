<?php
use app\modules\soc\models\Events;
?>
<div class="card">
<div class="card-header">
        สถิติการเกิดเหตุ
        </div>
    <div class="card-body">
 

            <?php foreach (Events::find()->where(['not',['event_type' => null]])->groupBy('event_type')->all() as $model):?>
            <div class="progress-group">
            <?=$model->eventType ? $model->eventType->name : null;?>
            <?php
            $result = $model->countPercen();
            ?>
                <span class="float-right"><b><?=$result['result']?></b>/<?=$result['total']?></span>
                <div class="progress progress-sm">
                    <div class="progress-bar bg-primary" style="width: <?=$result['result']?>%"></div>
                </div>
            </div>
            <?php endforeach;?>
            </div>
</div>