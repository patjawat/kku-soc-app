<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\cctv\models\CctvLocation $model */

$this->title = 'Create Cctv Location';
$this->params['breadcrumbs'][] = ['label' => 'Cctv Locations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cctv-location-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
