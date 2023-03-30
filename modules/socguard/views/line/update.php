<?php

use yii\helpers\Html;
use app\models\Category;
use app\modules\usermanager\models\User;
use kartik\datecontrol\DateControl;
use kartik\select2\Select2;
use kartik\widgets\FileInput;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use app\modules\socguard\models\Product;


/** @var yii\web\View $this */
/** @var app\modules\socguard\models\Borrow $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="borrow-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=$form->field($model, 'product_id')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(Product::find()->where(['active' => 0])->all(), 'id', 'item_code'),
    'size' => Select2::LARGE,
    'options' => ['placeholder' => 'ค้นหาหมายเลขเครื่อง', 'multiple' => false],
])->label(true);
?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-block btn-success']) ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>

<?php
$js =  <<< JS

$(document).on("select2:open", () => {
    document.querySelector(".select2-container--open .select2-search__field").focus()
  })
  
JS;
$this->registerJs($js);
?>