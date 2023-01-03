<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\socguard\models\Borrow $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="row justify-content-center mt-3" id="warp-content">
<div class="text-center" >
  <?=Html::img('@web/images/join2.png',['width' => '400px'])?>
</div>

    <?php $form = ActiveForm::begin(); ?>

    <div class="form-group">
        <?= Html::submitButton('ยืนยันการเบิก', ['class' => 'btn btn-lg btn-primary','id' => 'btn-save']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<div>
