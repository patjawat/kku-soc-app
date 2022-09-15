<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use app\modules\soc\models\Events;
use app\models\Category;
use yii\helpers\ArrayHelper;
use app\components\SystemHelper;


/* @var $this yii\web\View */
/* @var $searchModel app\models\EventsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Events';
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
    thead th {
    border-bottom-width: 2px;
    font-weight: 300;
}
</style>

<div class="events-index">
    <p>
        <?= Html::a('<i class="fas fa-plus"></i> สร้างใหม่', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
            [
                // 'header' => '<i class="fas fa-calendar-week"></i> วันที่รับบริการ',
                'attribute' => 'q_date',
                'format' => 'raw',
                'header' => '<i class="fas fa-calendar-week"></i> วันที่บริการ',
                'hAlign' => 'center',
                'vAlign' => 'middle',
                //'mergeHeader' => true,
                'width' => '12.5%',
                'options' => [
                    'format' => 'YYYY-MM-DD',
                ],
                'filterType' => GridView::FILTER_DATE_RANGE,
                'filterWidgetOptions' => [
                    'presetDropdown' => true,
                    'convertFormat' => false,
                    'language' => 'th',
                    'initRangeExpr' => true,
                    'pluginOptions' => [
                        'separator' => ' - ',
                        'format' => 'YYYY-MM-DD',
                        'locale' => [
                            'format' => 'YYYY-MM-DD',
                        ],
                        'ranges' => [
                            Yii::t('kvdrp', "วันนี้") => ["moment().startOf('day')", "moment()"],
                            Yii::t('kvdrp', "เมื่อวานนี้") => ["moment().startOf('day').subtract(1,'days')", "moment().endOf('day').subtract(1,'days')"],
                            Yii::t('kvdrp', "ย้อนหลัง {n} วัน", ['n' => 7]) => ["moment().startOf('day').subtract(6, 'days')", "moment()"],
                            Yii::t('kvdrp', "ย้อนหลัง {n} วัน", ['n' => 30]) => ["moment().startOf('day').subtract(29, 'days')", "moment()"],
                            Yii::t('kvdrp', "เดือนนี้") => ["moment().startOf('month')", "moment().endOf('month')"],
                            Yii::t('kvdrp', "เดือนที่แล้ว") => ["moment().subtract(1, 'month').startOf('month')", "moment().subtract(1, 'month').endOf('month')"],
                        ],
                    ],
                    'pluginEvents' => [
                        //"apply.daterangepicker" => "function() { apply_filter('q_date') }",
                        "apply.daterangepicker" => "function() { $('#my-status').submit() }",
                        // 'cancel.daterangepicker'=>"function(ev, picker) {\$('#daterangeinput').val(''); // clear any inputs};"
                        'cancel.daterangepicker' => "function() { console.log('clear') }",
                    ],
                ],
                'value' => function ($model) {
                    return Yii::$app->formatter->asDate($model->created_at, 'php:Y-m-d');
                },
            ],
            [
                'header' => 'เหตุการณ์',
                'attribute' => 'event_type',
                'hAlign' => 'center',
                'vAlign' => 'middle',
                'width' => '350px',
                'value' => function ($model) {
                    return $model->eventType ? $model->eventType->name : '';
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(Category::find()->where(['category_type' =>2])->all(), 'id', 'name'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'เลือกประเภทบุคลากร', 'multiple' => false], // allows multiple authors to be chosen
                'format' => 'raw',
            ],
            [
                'header' => 'ประเภทบุคลากร',
                'attribute' => 'person_type',
                'hAlign' => 'center',
                'vAlign' => 'middle',
                'width' => '11%',
                'value' => function ($model) {
                    return $model->personType ? $model->personType->name : '';
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(Category::find()->where(['category_type' =>1])->all(), 'id', 'name'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'เลือกประเภทบุคลากร', 'multiple' => false], // allows multiple authors to be chosen
                'format' => 'raw',
            ],
            'fullname',
            [
                'attribute' =>'result',
                'header' => 'ผลดำเนินการ',
                'hAlign' => 'center',
                'vAlign' => 'middle',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => [
                    null => 'รอดำเนินการ',
                    1 => 'พบเหตุการณ์',
                    2 => 'ไม่พบเหตุการณ์',
                ],
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'เลือกผลดำเนินการ', 'multiple' => false], // allows multiple authors to be chosen
                'format' => 'raw',
                'value' => function ($model) {
                    if($model->result == null) {
                            return '<span class="right badge badge-danger"><i class="fas fa-pause"></i> รอดำเนินการ</span>';
                    }else{
                        return $model->result == 1 ? ' <span class="right badge badge-success"><i class="fas fa-check"></i> พบเหตุการณ์</span>' : ' <span class="right badge badge-warning"><i class="fas fa-minus"></i> ไม่พบเหตุการร์</span>';
                    }
                }
            ],
            [
                'class' => 'kartik\grid\ActionColumn',
                'dropdown' => false,
                'vAlign'=>'middle',
                'header' => 'ดำเนินการ',
                'urlCreator' => function($action, $model, $key, $index) {
                        return Url::to([$action,'id'=>$key]);
                },
                'viewOptions'=>['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip'],
                'updateOptions'=>['role'=>'modal-remote-x','title'=>'Update', 'data-toggle'=>'tooltip'],
                'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete',
                                  'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                  'data-request-method'=>'post',
                                  'data-toggle'=>'tooltip',
                                  'data-confirm-title'=>'Are you sure?',
                                  'data-confirm-message'=>'Are you sure want to delete this item'],
            ],

            // [
            //     'class' => ActionColumn::className(),
            //     'urlCreator' => function ($action, Events $model, $key, $index, $column) {
            //         return Url::toRoute([$action, 'id' => $model->id]);
            //      }
            // ],
            
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
