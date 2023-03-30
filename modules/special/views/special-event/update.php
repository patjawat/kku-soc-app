<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\special\models\SpecialEvent $model */

$this->title = 'Update Special Event: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Special Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="special-event-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
