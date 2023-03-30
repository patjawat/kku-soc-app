<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\ActionColumn;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use app\modules\vehicle\models\Booking;


$this->title = 'รายการขอใช้ยานพาหนะ';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
td>img {
    width: 100px;
}
</style>

<div class="booking-index">


    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            [
                'class'=>'kartik\grid\SerialColumn',
                'width'=>'36px',
                'pageSummary'=>'Total',
                'pageSummaryOptions' => ['colspan' => 6],
                'header'=>'#',
            ],
            [
                'header' => 'รายละเอียดการขอใช้ยานพาหนะ',
                'width' => '60%',
                'format' => 'raw',
                'value' => function($model){
                    return $this->render('@app/modules/vehicle/views/booking/view_car',['model' => $model]);
                }
            ],
            [
                'attribute' =>'status_id',
                'format' =>'raw',
                'header' => 'สถานะ',
                'hAlign' => 'center',
                'vAlign' => 'middle',
                'value' => function($model){
                    // return isset($model->status) ? $model->status->title : '-';
                    return $this->render('@app/modules/vehicle/views/booking/booking_status',['model' => $model]);

                }
            ],
            [
                'class' => ActionColumn::className(),
                'hAlign' => 'center',
                'vAlign' => 'middle',
                'urlCreator' => function ($action, Booking $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>