<?php
$status = $model->status_id !== null ? $model->status_id : 0;
$progress = 0;
$color = null;
switch ($status) {
    case 18:
        $progress = 10;
        $color = 'bg-danger';
        break;

    case 19:
        $progress = 20;
        $color = 'bg-warning';

        break;
    case 20:
        $progress = 30;
        $color = 'bg-warning';

        break;
    case 21:
        $progress = 40;
        $color = 'bg-primary';

        break;
    case 23:
        $progress = 50;
        $color = 'bg-primary';

        break;
    case 24:
        $progress = 75;
        $color = 'bg-info';

        break;
    case 25:
        $progress = 100;
        $color = 'bg-success';

        break;
    default:
    $progress = 100;
    $color = 'bg-seconfary';
        break;
}
?>
<?php if($model->status_id !=null):?>
<div class="progress progress-sm">
<div class="progress-bar <?= $color ?>" role="progressbar" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100" style="width: <?= $progress ?>%">
</div>
</div>
<small>
<?= $progress ?>% <?= isset($model->status->name) ? $model->status->name : '' ?>
</small>
<?php endif;?>