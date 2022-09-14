<?php
use app\modules\soc\models\Events;
?>
<p class="text-center">
                <strong>สถานะการขอยื่น</strong>
            </p>
            <?php foreach (Events::find()->all() as $model):?>
            <div class="progress-group">
            <?=$model->eventType->name;?>
                <span class="float-right"><b>75</b>/75</span>
                <div class="progress progress-sm">
                    <div class="progress-bar bg-primary" style="width: 80%"></div>
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

