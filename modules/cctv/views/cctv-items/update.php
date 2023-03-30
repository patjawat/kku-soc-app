<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\cctv\models\CctvItems $model */

$this->title = 'Update Cctv Items: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Cctv Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cctv-items-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
