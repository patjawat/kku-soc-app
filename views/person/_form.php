<?php

use yii\helpers\Html;
use yii\web\View;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\Select2;
use kartik\datecontrol\DateControl;
use app\models\Category;
use app\models\Prefix;

$optiondate = ['type' => DateControl::FORMAT_DATE,'language' => 'th',];

?>

<div class="person-form container">

    <?php $form = ActiveForm::begin(); ?>
<div class=row>
    <div class=col-2>
    <?=
$form->field($model, 'prefix')->widget(Select2::classname(), [
    'data' =>  ArrayHelper::map(Prefix::find()->all(),'id','name'),
    'options' => ['placeholder' => 'คำนำหน้า'],
    'pluginOptions' => [
        'allowClear' => true,
    ],
]);
?>
    </div>
    <div class=col-4>
        <?= $form->field($model, 'fname')->textInput(['maxlength' => true]) ?>

</div>
<div class=col-4>
    <?= $form->field($model, 'lname')->textInput(['maxlength' => true]) ?>

</div>
</div>



<div class=row>
<div class=col-12>
    <?=
$form->field($model, 'organization')->widget(Select2::classname(), [
    'data' =>  ArrayHelper::map(Category::find()->where(['category_type' => 1])->all(),'id','name'),
    'options' => ['placeholder' => 'คณะ'],
    'pluginOptions' => [
        'allowClear' => true,
    ],

]);
?>
<?=
$form->field($model, 'req_position')->widget(Select2::classname(), [
    'data' =>  ArrayHelper::map(Category::find()->where(['category_type' => 2])->all(),'id','name'),
    'options' => ['placeholder' => 'ตำแหน่ง'],
    'pluginOptions' => [
        'allowClear' => true,
    ],

]);
?>

<?=
$form->field($model, 'study')->widget(Select2::classname(), [
    'data' =>  ArrayHelper::map(Category::find()->where(['category_type' => 3])->all(),'id','name'),
    'options' => ['placeholder' => 'สาขาวิชา'],
    'pluginOptions' => [
        'allowClear' => true,
    ],

]);
?>
</div>


</div>

<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton('<i class="fas fa-check"></i> บันทึก', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$js = <<< JS
$(document).on("select2:open", () => {
    document.querySelector(".select2-container--open .select2-search__field").focus()
  })
JS;
$this->registerJs($js,View::POS_END);
?>