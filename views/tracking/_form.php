<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\Select2;
use kartik\datecontrol\DateControl;
use app\models\Person;
use app\models\Category;
/* @var $this yii\web\View */
/* @var $model app\models\Tracking */
/* @var $form yii\widgets\ActiveForm */

$optiondatetime = [
    'type' => DateControl::FORMAT_DATE,
'language' => 'th',
'class' => 'xx',
'pluginEvents' => [
    "change" => "function(){
        var dateVal = $(this).val();
        var view = $(this).attr('id')+'-'+'label'
        // thaiDatetime(dateVal,view)
    }",
]
];
?>

<div class="tracking-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'person_id')->widget(Select2::classname(), [
    'data' =>  ArrayHelper::map(Person::find()->all(),'id',function($model) {
        return $model->fullname();
    }),
    'options' => ['placeholder' => 'ชื่อผู้ยื่นขอ'],
    'pluginOptions' => [
        'allowClear' => true,
    ],
]); ?>

    <?= $form->field($model, 'status_id')->widget(Select2::classname(), [
    'data' =>  ArrayHelper::map(Category::find()->where(['category_type' => 4])->all(),'id','name'),
    'options' => ['placeholder' => 'สถานะ'],
    'pluginOptions' => [
        'allowClear' => true,
    ],
]); ?>

<?= $form->field($model, 'approve')->widget(DateControl::classname(), $optiondatetime);?>
<?= $form->field($model, 'approve_result_date')->widget(DateControl::classname(), $optiondatetime);?>
<?= $form->field($model, 'tracking')->widget(DateControl::classname(), $optiondatetime);?>

    <div class="form-group">
        <?= Html::submitButton('<i class="fas fa-check"></i> บันทึก', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
