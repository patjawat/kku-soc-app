<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\cctv\models\CctvLocation $model */

$this->title = 'CCTV: ' . $model->location_name;
$this->params['breadcrumbs'][] = ['label' => 'Cctv Locations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cctv-location-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
