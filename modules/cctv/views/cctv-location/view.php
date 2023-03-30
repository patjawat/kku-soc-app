<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use app\modules\cctv\models\CctvItems;
use yii\grid\ActionColumn;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\modules\cctv\models\CctvLocation $model */

$this->title = $model->location_name;
$this->params['breadcrumbs'][] = ['label' => 'Cctv Locations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="cctv-location-view">
<div class="d-flex justify-content-between">
<p>
        <?= Html::a('แก้ไข', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('ลบทิ้ง', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

<p>
        <?= Html::a('สร้างใหม่', ['/cctv/cctv-items/create','location_id' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>

</div>
 

    <?php
    //  DetailView::widget([
    //     'model' => $model,
    //     'attributes' => [
    //         'location_name',
    //     ],
    // ]) 
    ?>

</div>




    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class'=>'kartik\grid\SerialColumn',
                'contentOptions'=>['class'=>'kartik-sheet-style'],
                'width'=>'36px',
                'pageSummary'=>'Total',
                'pageSummaryOptions' => ['colspan' => 6],
                'header'=>'',
                'headerOptions'=>['class'=>'kartik-sheet-style']
            ],
            
            'address',
            [
                'class' => 'kartik\grid\BooleanColumn',
                'attribute' => 'active', 
                'vAlign' => 'middle',
                'width' => '200px',
            ], 
            [
                'class' => 'kartik\grid\ActionColumn',
                'urlCreator' => function($action, $model, $key, $index) {
                    return Url::toRoute(['cctv-items/'.$action, 'id' => $model-> id]);
                 },
                'deleteOptions' => ['title' => 'This will launch the book delete action. Disabled for this demo!', 'data-toggle' => 'tooltip'],
                'headerOptions' => ['class' => 'kartik-sheet-style'],
            ],
        ],
    ]); ?>

 