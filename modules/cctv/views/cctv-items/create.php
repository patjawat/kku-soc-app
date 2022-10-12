<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\cctv\models\CctvItems $model */

$this->title = 'Create Cctv Items';
$this->params['breadcrumbs'][] = ['label' => 'Cctv Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cctv-items-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
