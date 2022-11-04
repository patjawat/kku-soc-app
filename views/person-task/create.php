<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PersonTask */

$this->title = 'Create Person Task';
$this->params['breadcrumbs'][] = ['label' => 'Person Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="person-task-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
