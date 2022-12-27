<?php

use yii\helpers\Html;
// use yii\bootstrap4\ActiveForm;
use kartik\form\ActiveForm;
use kartik\daterange\DateRangePicker;
?>
<?php
if ($model->q_date){

    $date_explode = explode(" - ", $model->q_date);
    $date1 = trim($date_explode[0]);
    $date2 = trim($date_explode[1]);
}else{
    $date1 = '';
    $date2 = '';
}


?>
<div class="events-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>
<div class="row">
<div class="col-3">
    <?php
    echo $form->field($model, 'q_date', [
        'options'=>['class'=>'drp-container mb-2']
    ])->widget(DateRangePicker::classname(), [
        'options' => [
            'format' => 'YYYY-MM-DD',
        ],
        'presetDropdown' => true,
                    'convertFormat' => false,
                    'language' => 'th',
                    'initRangeExpr' => true,
                    'pluginOptions' => [
                        'separator' => ' - ',
                        'format' => 'YYYY-MM-DD',
                        'locale' => [
                            'format' => 'YYYY-MM-DD',
                        ],
                        'ranges' => [
                            Yii::t('kvdrp', "วันนี้") => ["moment().startOf('day')", "moment()"],
                            Yii::t('kvdrp', "เมื่อวานนี้") => ["moment().startOf('day').subtract(1,'days')", "moment().endOf('day').subtract(1,'days')"],
                            Yii::t('kvdrp', "ย้อนหลัง {n} วัน", ['n' => 7]) => ["moment().startOf('day').subtract(6, 'days')", "moment()"],
                            Yii::t('kvdrp', "ย้อนหลัง {n} วัน", ['n' => 30]) => ["moment().startOf('day').subtract(29, 'days')", "moment()"],
                            Yii::t('kvdrp', "เดือนนี้") => ["moment().startOf('month')", "moment().endOf('month')"],
                            Yii::t('kvdrp', "เดือนที่แล้ว") => ["moment().subtract(1, 'month').startOf('month')", "moment().subtract(1, 'month').endOf('month')"],
                        ],
                    ],
                    'pluginEvents' => [
                        //"apply.daterangepicker" => "function() { apply_filter('q_date') }",
                        "apply.daterangepicker" => "function() { $('#my-status').submit() }",
                        // 'cancel.daterangepicker'=>"function(ev, picker) {\$('#daterangeinput').val(''); // clear any inputs};"
                        'cancel.daterangepicker' => "function() { console.log('clear') }",
                    ],
    ])->label('ระบุวันที่');
    ?>
      
</div>
<div class="col-3">


    <div class="form-group" style="margin-top:31px;">
        <?= Html::submitButton('ค้นหา', ['class' => 'btn btn-primary']) ?>
        <?=Html::a('ดาวน์โหลดเอกสาร', Url::to(Yii::getAlias('@web') . '/msword/ms_word_result.docx'), ['class' => 'btn btn-info'])?>
        <?=Html::a('พิมพ์',['/soc/report/word-style2','date1' => $date1,'date2' => $date2],['class' => 'btn btn-success','target' => '_blank'])?>
    </div>
    
    </div>
</div>
    <?php ActiveForm::end(); ?>

</div>
