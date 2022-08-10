<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Reader */

$this->title = 'Update Reader: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Readers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="reader-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
