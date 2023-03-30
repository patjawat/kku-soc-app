<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\socguard\models\Product $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'item_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'active')->textInput() ?>

    <?php //  $form->field($model, 'product_type')->textInput(['maxlength' => true]) ?>

    <div style="margin-top:10px">
    <?= $form->field($model,'file')->fileInput(); ?>
</div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<div>
            <?= Html::img(['/file','id'=>$model->photo]) ?>
        </div>
        <?=$model->photo;?>
