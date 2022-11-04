<?php
use yii\helpers\Html;
/* @var $this yii\web\View */
?>
<div class="container">

<?php foreach($dataProvider->getModels() as $model):?>

<div class="card card-widget collapsed-card shadow-none">
    <div class="card-header">
        <div class="user-block">
            <img class="img-circle" src="https://adminlte.io/themes/v3/dist/img/user1-128x128.jpg" alt="User Image">
            <span class="username">
                <?=Html::a($model->fname.' '.$model->lname,['/liff/view','id' => $model->id])?>
            </span>
            <span class="description">
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
                                  
                        </span>
        </div>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" title="Mark as read">
                <i class="far fa-circle"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-plus"></i>
            </button>
            <!-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
            </button> -->
        </div>

    </div>

    <div class="card-body" style="display: none;">


    </div>

    <div class="card-footer card-comments" style="display: none;">
        

    </div>

    <div class="card-footer" style="display: none;">

    </div>

</div>
<?php endforeach; ?>
</div>

