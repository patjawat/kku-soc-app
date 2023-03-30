<?php

use app\modules\cctv\models\CctvLocation;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\modules\cctv\models\CctvLocationSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'กล้องวงจรปิด';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cctv-location-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('สร้างใหม่', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'location_name',
            'data_json:ntext',
            'active',
            'created_at',
            //'updated_at',
            //'created_by',
            //'updated_by',
            // [
            //     'class' => ActionColumn::className(),
            //     'urlCreator' => function ($action, CctvLocation $model, $key, $index, $column) {
            //         return Url::toRoute([$action, 'id' => $model->id]);
            //      }
            // ],
            [
                'class' => 'kartik\grid\ActionColumn',
                'template'=>'{add}',
                'buttons'=>[
                  'add' => function($url,$model,$key){
                    //   return Html::a('เพิ่ม',['category/create','id' => $model->id]);
                      return Html::a('เปิด',['cctv-location/view','id' => $model->id]);
                    }
                  ]
              ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
