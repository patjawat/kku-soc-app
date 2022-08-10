<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\usermanager\models\User */

$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<?=$this->render('../default/navlink');?>

<div class="card">
    <div class="card-header">
    <h2 class="card-title"><i class="fas fa-list-ul"></i>  <?= $model->fullname;?></h2>
        <div class="card-tools">
        <p style="margin-bottom: 0px;">
        <?= Html::a('<i class="far fa-edit"></i> แก้ไข', ['update', 'id' => $model->id], ['class' => 'btn btn-primary link-loading']); ?>
            <?= Html::a('<i class="fas fa-trash"></i> ลบทิ้ง', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data-confirm' => Yii::t('rbac-admin', 'Are you sure to delete this item?'),
                'data-method' => 'post',
            ]); ?>
    </p>
        </div>
    </div>
    <div class="card-body">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'username',
            'email:email',
            'pname',
            'fullname',
        ],
    ]) ?>
    </div>
</div>

