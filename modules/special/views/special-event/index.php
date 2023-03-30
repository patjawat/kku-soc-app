<?php

use app\modules\special\models\SpecialEvent;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\modules\special\models\SpecialEventSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'บันทึกประจำวัน';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="special-event-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Special Event', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'ref',
            'data_json:ntext',
            'special_date',
            'location',
            //'title',
            //'special_event_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, SpecialEvent $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
