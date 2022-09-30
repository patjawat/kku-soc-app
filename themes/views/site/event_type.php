<?php
use app\modules\soc\models\Events;
?>
<p class="text-center">
                <strong>สถานะการขอยื่น</strong>
            </p>
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
        
<!-- 
            <div class="progress-group">
            บุคลากร
                <span class="float-right"><b>75</b>/75</span>
                <div class="progress progress-sm">
                    <div class="progress-bar bg-danger" style="width: 75%"></div>
                </div>
            </div>

            <div class="progress-group">
                <span class="progress-text">ภายนอก</span>
                <span class="float-right"><b>33</b>/75</span>
                <div class="progress progress-sm">
                    <div class="progress-bar bg-success" style="width: 60%"></div>
                </div>
            </div> -->

