<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tracking */

$this->title = 'Create Tracking';
$this->params['breadcrumbs'][] = ['label' => 'Trackings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tracking-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
