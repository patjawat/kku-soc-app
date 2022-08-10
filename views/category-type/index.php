<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\CategoryTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'หมวดหมู่ต่างๆ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-type-index">

    <p>
        <?= Html::a('<i class="fas fa-plus"></i> สร้างใหม่', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'type_name',
            'title',
           
            [
                'class' => 'kartik\grid\ActionColumn',
                'template'=>'{add}',
                'buttons'=>[
                  'add' => function($url,$model,$key){
                      return Html::a('เพิ่ม',['category/create','id' => $model->id]);
                    }
                  ]
              ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
