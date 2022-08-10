<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\modules\usermanager\components\RouteRule;
use app\modules\usermanager\components\Configs;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel app\modules\usermanager\models\searchs\AuthItem */
/* @var $context app\modules\usermanager\components\ItemController */

$context = $this->context;
$labels = $context->labels();

$this->params['breadcrumbs'][] = $this->title;

$rules = array_keys(Configs::authManager()->getRules());
$rules = array_combine($rules, $rules);
unset($rules[RouteRule::RULE_NAME]);
?>
<style>
#role-grid table thead {
    background-color: #fff;
}
#role-grid-container{
  height:480px;
}
</style>
<h2><i class="fas fa-user-tag"></i> บทบาท</h2>
<?=$this->render('../default/navlink');?>
<div class="clearfix"></div>
<div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-list-ul"></i> รายการ<?=$this->title;?></h3>

                <div class="card-tools">
                 <div>
                 <?=Html::a('<i class="fas fa-plus"></i> สร้างใหม่',['/usermanager/role/create'],['class'=>"btn btn-success link-loading"]);?>
                  </div> 
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 500px;">
              <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'id' => 'role-grid',
        'pjax' => true,
        'showHeader' => true,
        'showPageSummary' => false,
        'layout' => '{items}{pager}',
        'floatHeader' => true,
        'floatHeaderOptions' => ['scrollingTop' => '20'],
        'perfectScrollbar' => true,
        'footerRowOptions' => ['style' => 'font-weight:bold;text-decoration: underline; position: absolute'],
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
            [
                'attribute' => 'name',
                'label' => 'ชื่อบทบาท',
            ],
            [
                'attribute' => 'ruleName',
                'label' => 'ชื่อกฏ',
                'filter' => $rules
            ],
            [
                'attribute' => 'description',
                'label' =>'รายละเอียด',
            ],
            [
              'class' => 'app\modules\usermanager\grid\ActionColumn',
              'header' => '<center>ดำเนินการ<center>',
              'width' => '130px',
              'dropdown' => false,
              'vAlign' => 'middle',
            ],
        ],
    ])
    ?>