
<?php
use yii\helpers\Html;
use kartik\select2\Select2;
use kartik\widgets\DateTimePicker;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\vehicle\models\Category;
/** @var yii\web\View $this */
/** @var app\modules\vehicle\models\Category $model */
/** @var yii\widgets\ActiveForm $form */
?>

<style>
    .box-img{
        position: relative;
        /* width:500px; */
    }
    .box-img > img{
        width:500px;
    }
</style>
<div class="row">
    <div class="col-6">

    <?php $form = ActiveForm::begin(); ?>
    <?php //  $form->field($model, 'site')->textInput(['value' => 'site'])->label('ยี่ห้อ') ?>
    <?php //  $form->field($model, 'data_json[site_name]')->textInput(['rows' => 6])->label('ชื่อเว็บไซต์') ?>
    ระบบทะเบียนวิทยุ
    <?= $form->field($model, 'data_json[guard_line_token]')->textInput(['rows' => 6])->label('Line_token') ?>
    <?= $form->field($model, 'data_json[guard_richmenu_register]')->textInput(['rows' => 6])->label('Register richmenu ID') ?>
    <?= $form->field($model, 'data_json[guard_richmenu_mainmenu]')->textInput(['rows' => 6])->label('MainMenu richmenu ID') ?>
    <div class="box-img" data-aos="fade-left">
            <?= Html::img(['/file','id'=>$model->photo]) ?>
        </div>
    <?= Html::submitButton('<i class="fa-solid fa-check"></i> บันทึก', ['class' => 'btn btn-success']) ?>

<?= Html::a('<i class="fas fa-redo"></i> ยกเลิก', ['/usermanager/user'], ['class' => 'btn btn-secondary link-loading', 'title' =>  'Reset Grid']) ?>

    <?php ActiveForm::end(); ?>

</div>
</div>
