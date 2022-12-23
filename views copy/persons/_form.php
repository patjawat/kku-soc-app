<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\Select2;
use app\models\Category;


/* @var $this yii\web\View */
/* @var $model app\models\Persons */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="persons-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lname')->textInput(['maxlength' => true]) ?>


    <?=
$form->field($model, 'organization')->widget(Select2::classname(), [
    'data' =>  ArrayHelper::map(Category::find()->where(['category_type' => 1])->all(),'id','name'),
    'options' => ['placeholder' => 'ท่าวัดความดันโลหิต'],
    'pluginOptions' => [
        'allowClear' => true,
    ],

]);
?>

<?=
$form->field($model, 'position')->widget(Select2::classname(), [
    'data' =>  ArrayHelper::map(Category::find()->where(['category_type' => 2])->all(),'id','name'),
    'options' => ['placeholder' => 'ท่าวัดความดันโลหิต'],
    'pluginOptions' => [
        'allowClear' => true,
    ],

]);
?>
<?=
$form->field($model, 'study')->widget(Select2::classname(), [
    'data' =>  ArrayHelper::map(Category::find()->where(['category_type' => 3])->all(),'id','name'),
    'options' => ['placeholder' => 'ท่าวัดความดันโลหิต'],
    'pluginOptions' => [
        'allowClear' => true,
    ],

]);
?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
