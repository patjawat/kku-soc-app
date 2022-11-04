<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\grid\ActionColumn;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use app\models\Person;
use app\models\Category;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PersonSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'รายชื่อผู้ยื่นขอ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="person-index">

    <p>
        <?= Html::a(
            '<i class="fas fa-user-plus"></i> เพิ่มใหม่',
            ['create'],
            ['class' => 'btn btn-success show']
        ) ?>

    </p>

    <?php Pjax::begin(); ?>
    <?php
// echo $this->render('_search', ['model' => $searchModel]);
?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class'=>'kartik\grid\SerialColumn',
                'contentOptions'=>['class'=>'kartik-sheet-style'],
                'width'=>'3%',
                'pageSummary'=>'Total',
                'pageSummaryOptions' => ['colspan' => 6],
                'header'=>'',
                'headerOptions'=>['class'=>'kartik-sheet-style']
            ],
            [
                'attribute' => 'fullname',
                'header' => 'ชื่อ-นามสกุล',
                'hAlign' => 'left',
                'vAlign' => 'middle',
                'width' => '20%',
                'value' => function ($model) {
                    return $model->fullname();
                },
            ],
            [
                'attribute' => 'status_id',
                'format' => 'raw',
                // 'width' => '40%',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(
                    Category::find()->where(['category_type' => 4])->all(),
                    'id',
                    'name'
                ),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => [
                    'placeholder' => 'ระบุสถานะ',
                    'multiple' => false,
                ], // allows multiple authors to be chosen
                'format' => 'raw',
                'value' => function ($model) {
                    return $this->render('progress', ['model' => $model]);

                    // return '<span class="badge badge-success">Success</span>';
                },
            ],
            [
                'attribute' => 'organization',
                'hAlign' => 'center',
                // 'width' => '30%',
                'vAlign' => 'middle',
                'value' => function ($model) {
                    return $model->org->name;
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(
                    Category::find()->all(),
                    'id',
                    'name'
                ),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => [
                    'placeholder' => 'ระบุคณะ',
                    'multiple' => false,
                ], // allows multiple authors to be chosen
                'format' => 'raw',
            ],

            [
                'class' => ActionColumn::className(),
                'width' => '110px',
                'urlCreator' => function (
                    $action,
                    Person $model,
                    $key,
                    $index,
                    $column
                ) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
            ],
            

        ],
    ]) ?>

    <?php Pjax::end(); ?>

</div>


