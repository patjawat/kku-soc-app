<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use app\modules\soc\models\Events;
use app\models\Uploads;
use app\models\Category;
use yii\helpers\ArrayHelper;
use app\components\SystemHelper;
use app\components\UserHelper;




/* @var $this yii\web\View */
/* @var $searchModel app\models\EventsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'บันทึกเหตการณ์';
$this->params['breadcrumbs'][] = $this->title;
?>
 <?php //  Pjax::begin(); ?>
<style>
    thead th {
    border-bottom-width: 2px;
    font-weight: 300;
}
</style>

<?php
if ($searchModel->q_date){

    $date_explode = explode(" - ", $searchModel->q_date);
    $date1 = trim($date_explode[0]);
    $date2 = trim($date_explode[1]);
}else{
    $date1 = '';
    $date2 = '';
}
?>



<div class="events-index">


<div class="d-flex justify-content-between">
    <div>
        <?= Html::a('<i class="fas fa-plus"></i> สร้างใหม่', ['create'], ['class' => 'btn btn-success']) ?>
        
    </div>
    <div>
        <?php //  Html::a('<i class="fas fa-print"></i> พิมพ์รายงาน', ['/soc/default/word','date1' => $date1,'date2' => $date2], ['class' => 'btn btn-primary','data-pjax' => false,'target' => '_blank']) ?>
    </div>
  </div>
    <p>
    </p>

   
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
                'header' => '<i class="fas fa-calendar-week"></i> วันเวลาแจ้ง',
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
                    // return Yii::$app->formatter->asDate($model->created_at, 'php:Y-m-d');
                    return $model->created_at;
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
                'header' => 'ผู้รับเรื่อง',
                'attribute' => 'reporter',
                'hAlign' => 'center',
                'vAlign' => 'middle',
                'width' => '11%',
                'value' => function ($model) {
                    return $model->getUser();
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => UserHelper::getUserAll(),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'เลือกประเภทบุคลากร', 'multiple' => false], // allows multiple authors to be chosen
                'format' => 'raw',
            ],
            [
                'header' => 'ระยะเวลาดำเนินการ',
                'hAlign' => 'center',
                'vAlign' => 'middle',
                'value' => function ($model){
                    return $model->CountDate();
                }
            ],
            [
                'attribute' =>'result',
                'header' => 'ผลดำเนินการ',
                'hAlign' => 'center',
                'vAlign' => 'middle',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(Category::find()->where(['category_type' =>5])->all(), 'id', 'name'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'เลือกผลดำเนินการ', 'multiple' => false], // allows multiple authors to be chosen
                'format' => 'raw',
                'value' => function ($model) {

                    if($model->reporter == null) {
                        return '<span class="right badge badge-danger"><i class="fas fa-pause"></i> รอดำเนินการ</span>';
                    }else{
                        return $model->resultType ? $model->resultType->name : 'รอผล';
                    }
                }
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Events $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
            
        ],
    ]); ?>

    <?php //  Pjax::end(); ?>

</div>
