<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\special\models\SpecialEvent $model */

$this->title = 'Create Special Event';
$this->params['breadcrumbs'][] = ['label' => 'Special Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="special-event-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'initialPreview'=>[],
        'initialPreviewConfig'=>[]
    ]) ?>

</div>
