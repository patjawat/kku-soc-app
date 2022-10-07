<?php
use app\modules\soc\models\Events;
$i =  10;
?>

<p class="text-center" data-aos="fade-up" data-aos-delay="900">
                <strong>สถานะการขอยื่น</strong>
            </p>
            <?php foreach (Events::find()->where(['not',['event_type' => null]])->groupBy('event_type')->all() as $model):?>
            <div class="progress-group" data-aos="fade-up" data-aos-delay="<?=($i++)*100?>">
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

