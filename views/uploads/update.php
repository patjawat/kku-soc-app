<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Uploads */

$this->title = 'Update Uploads: ' . $model->upload_id;
$this->params['breadcrumbs'][] = ['label' => 'Uploads', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->upload_id, 'url' => ['view', 'upload_id' => $model->upload_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="uploads-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
