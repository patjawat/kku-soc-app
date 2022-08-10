<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\CategoryTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Category Types';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-type-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Category Type', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'type_name',
            'title',
            // [
            //     'class' => ActionColumn::className(),
            //     'urlCreator' => function ($action, CategoryType $model, $key, $index, $column) {
            //         return Url::toRoute([$action, 'id' => $model->id]);
            //      }
            // ],
            // [
            //     'class' => 'kartik\grid\ActionColumn',
            //     // 'dropdown' => $this->dropdown,
            //     'dropdownOptions' => ['class' => 'float-right'],
            //     'urlCreator' => function($action, $model, $key, $index) { return '#'; },
            //     'viewOptions' => ['title' => 'This will launch the book details page. Disabled for this demo!', 'data-toggle' => 'tooltip'],
            //     'updateOptions' => ['title' => 'This will launch the book update page. Disabled for this demo!', 'data-toggle' => 'tooltip'],
            //     'deleteOptions' => ['title' => 'This will launch the book delete action. Disabled for this demo!', 'data-toggle' => 'tooltip'],
            //     'headerOptions' => ['class' => 'kartik-sheet-style'],
            // ],
            // ['class' => 'kartik\grid\ActionColumn'],
            [
                'class' => 'kartik\grid\ActionColumn',
                'template'=>'{add}',
                'buttons'=>[
                  'add' => function($url,$model,$key){
                      return Html::a('add',['category/create','id' => $model->id]);
                    }
                  ]
              ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
