<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PersonTask */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Person Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="person-task-view">
    <p>
        <?php //  Html::a('ย้อนกลับ', ['update', 'id' => $model->id], ['class' => 'btn btn-block btn-primary']) ?>
        <?= Html::a('ย้อนกลับ', ['index'], ['class' => 'btn btn-block btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'fname',
            'lname'
        ],
    ]) ?>

</div>
