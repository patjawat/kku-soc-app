<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\Persons;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PersonsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Persons';
$this->params['breadcrumbs'][] = $this->title;

                        //   $bgColor = '';
                        //   switch ($model->progressPerson()) {
                        //     case 1:
                        //         $bgColor = 'bg-danger';
                        //     case 24:
                        //         $bgColor = 'bg-warning';
                        //     case 36:
                        //         $bgColor = 'bg-info';
                        //     case 48:
                        //         $bgColor = 'bg-info';
                        //     case 60:
                        //         $bgColor = 'bg-primary';
                        //     case 42:
                        //         $bgColor = 'bg-primary';
                        //     case 48:
                        //         $bgColor = 'bg-primary';
                        //     case 100:
                        //         $bgColor = 'bg-success';
                        //     default:
                        //       return '';
                        //     }
                        

?>
<div class="persons-index">
    <p>
        <?= Html::a(
            'Create Persons',
            ['create'],
            ['class' => 'btn btn-success']
        ) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php
// echo $this->render('_search', ['model' => $searchModel]);
?>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Projects</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th style="width: 1%">
                            #
                        </th>
                        <th style="width: 15%">
                            Project Name
                        </th>
                        <th style="width: 10%">
                            Team Members
                        </th>
                        <th style="width: 30%">
                            Project Progress
                        </th>
                        <!-- <th style="width: 8%" class="text-center">
                            Status
                        </th> -->
                        <th style="width: 20%">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($dataProvider->getModels() as $model):?>
                        
                    <tr>
                        <td>
                            #
                        </td>
                        <td>
                            <?=$model->fname.' '.$model->lname;?>
        
                        </td>
                        <td>
                            <ul class="list-inline">
                                <?php foreach($model->readers as $reader):?>
                                <li class="list-inline-item">
                                    <?=Html::img('@web/img/avatar.png',['class' => 'table-avatar']);?>
                    
                                </li>
                                <?php endforeach;?>
                            </ul>
                        </td>
                        <td class="project_progress">
                        <?php
                        $n = $model->progressPerson();
                        if($n == 1){
                            $bgColor = 'bg-danger';
                        }else if($n == 24){
                            $bgColor = 'bg-warning';
                        }else if($n == 36){
                            $bgColor = 'bg-info';
                        }else if($n == 48){
                            $bgColor = 'bg-info';
                        }else if($n == 60){
                            $bgColor = 'bg-info';
                        }else if($n == 72){
                            $bgColor = 'bg-info';
                    
                        }else if($n == 48){
                            $bgColor = 'bg-primary';
                    
                    }else{
                        $bgColor = 'bg-success';

                    }
                        ?>
                            <div class="progress progress-sm">
                                <div class="progress-bar <?=$bgColor;?>" role="progressbar" aria-valuenow="57"
                                    aria-valuemin="0" aria-valuemax="100" style="width: <?=$model->progressPerson();?>%">
                                </div>
                            </div>
                            <small>
                                <?=$model->progressPerson();?>%  &nbsp;(<?=$model->step->name;?>)
                            </small>
                        </td>
                       
                        <td class="project-actions text-right">
                            <?=Html::a('<i class="fas fa-folder"></i>View',['/person/view','id' => $model->id],['class' => 'btn btn-primary btn-sm'])?>
                            <a class="btn btn-info btn-sm" href="#">
                                <i class="fas fa-pencil-alt">
                                </i>
                                Edit
                            </a>
                            <a class="btn btn-danger btn-sm" href="#">
                                <i class="fas fa-trash">
                                </i>
                                Delete
                            </a>
                        </td>
                    </tr>
            <?php endforeach; ?>

                </tbody>
            </table>
        </div>

    </div>

    <?php Pjax::end(); ?>

</div>