<?php
$title = "ยังไม่รับเรื่อง";
/** @var yii\web\View $this */

?>
<h1 class="text-center">ยังไม่รับเรื่อง</h1>
<?php foreach ($models as $model):?>
<div class="card card-widget collapsed-card">
    <div class="card-header">
        <div class="user-block">
            <img class="img-circle" data-cfsrc="../dist/img/user1-128x128.jpg" alt="User Image"
                src="https://adminlte.io/themes/v3/dist/img/user1-128x128.jpg">
            <span class="username"><a href="#"><?=$model->eventType->name;?></a></span>
            <span class="description">เวลาเกิดเหตุ <?=$model->event_date;?></span>
        </div>

        <div class="card-tools">

            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-plus"></i>
            </button>
       
        </div>

    </div>

    <div class="card-body" style="display: none;">
        <button type="button" class="btn btn-default btn-sm"><i class="fas fa-share"></i> Share</button>
        <button type="button" class="btn btn-default btn-sm"><i class="far fa-thumbs-up"></i> Like</button>
        <span class="float-right text-muted">45 likes - 2 comments</span>
    </div>
    <div class="card-footer" style="display: none;">
        <form action="#" method="post">
            <img class="img-fluid img-circle img-sm" data-cfsrc="../dist/img/user4-128x128.jpg" alt="Alt Text"
                src="https://adminlte.io/themes/v3/dist/img/user4-128x128.jpg">

            <div class="img-push">
                <input type="text" class="form-control form-control-sm" placeholder="Press enter to post comment">
            </div>
        </form>
    </div>

</div>
<?php endforeach;?>