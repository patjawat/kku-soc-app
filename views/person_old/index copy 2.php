<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\GridView;
use app\models\Persons;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PersonsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Persons';
$this->params['breadcrumbs'][] = $this->title;

$layout = <<< HTML
<div class="clearfix"></div>
<div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-list-ul"></i> รายการ{$this->title}</h3>

                <div class="card-tools">
                 <div style="width: 400px;">
                    {$this->render('_search', ['model' =>$searchModel])}
                  </div> 
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 500px;">
              {items}
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-left">
                {summary}
                </ul>
                <ul class="pagination pagination-sm m-0 float-right">       
                  {pager}
                </ul>
              </div>
            </div>

HTML;

                 

?>


<?= GridView::widget([
  'id' => 'user-grid',
  'dataProvider' => $dataProvider,
  //   'filterModel' => $searchModel,
  'pjax' => true,
  'showHeader' => true,
  'showPageSummary' => false,
  'layout' => '{items}{pager}',
  'floatHeader' => true,
  'floatHeaderOptions' => ['scrollingTop' => '20'],
  'tableOptions'=>['class'=>'table table-bordered table-striped dataTable table-hover table-sm'],
  'perfectScrollbar' => true,
  'footerRowOptions' => ['style' => 'font-weight:bold;text-decoration: underline; position: absolute'],
  'layout' => $layout,
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
    [
      'attribute' => 'fullname',
      'width'=>'15%',
      'header' =>'<i class="far fa-user"></i> | ชื่อเข้าใช้งาน',
      'value' => function ($model, $key, $index, $widget) {
          return $model->fname.' '.$model->lname;
      }
  ],
  [
    // 'attribute' => 'email',
    'format' => 'raw',
    'header' =>'<i class="fas fa-address-card"></i> | ชื่อ-นามสกุล',
    'value' => function ($model, $key, $index, $widget) {
        return $this->render('reader',['model' => $model]);
    }
],
[
    // 'attribute' => 'email',
    'format' => 'raw',
    'width'=>'30%',
    'header' =>'<i class="fas fa-address-card"></i> | ชื่อ-นามสกุล',
    'value' => function ($model, $key, $index, $widget) {
        return $this->render('step',['model' => $model]);
    }
],
[
    // 'attribute' => 'email',
    'format' => 'raw',
    'width'=>'30%',
    'header' =>'<i class="fas fa-address-card"></i> | ชื่อ-นามสกุล',
    'value' => function ($model, $key, $index, $widget) {
        return $this->render('action',['model' => $model]);
    }
],

//     [
//       'attribute' => 'status',
//       'class' => 'kartik\grid\BooleanColumn',
//       'vAlign' => 'middle',
//       'header' => '<i class="fas fa-unlock-alt"></i> สถานะ',
//       'format' => 'html',
//       'filter' => $searchModel->itemStatus,
//       'value' => function ($model) {
//         return $model->statusName == 'Active' ? '<span class="text-success">' . $model->statusName . '</span>' : $model->statusName;
//       }
//     ],
//     // 'created_at:dateTime',
//     [
//       'attribute' => 'created_at',
//       'header' => '<i class="fas fa-calendar-alt"></i> สร้างเมื่อ',
//       'format' => 'html',
//       'filter' => $searchModel->itemStatus,
//       'value' => function ($model) {
//         return Yii::$app->thaiFormatter->asDateTime($model->created_at, 'short');
//       }
//     ],
//     [
//       'class' => 'app\modules\usermanager\grid\ActionColumn',
//       'header' => '<center>ดำเนินการ<center>',
//       'width' => '130px',
//       'dropdown' => false,
//       'vAlign' => 'middle',
//     ],

  ],
]); ?>
