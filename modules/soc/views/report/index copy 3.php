<?php
use yii\helpers\Url;
use yii\helpers\Html;
?>
<h1>ระบบรายงานประจำเดือน</h1>
<div class="row">
    <div class="col-3">
        <?php echo $this->render('_search', ['model' => $searchModel]); ?>
        <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
<a class="nav-link active" id="vert-tabs-home-tab" data-toggle="pill" href="#vert-tabs-home" role="tab" aria-controls="vert-tabs-home" aria-selected="true">รายงานบบที่ 1</a>
<a class="nav-link" id="vert-tabs-profile-tab" data-toggle="pill" href="#vert-tabs-profile" role="tab" aria-controls="vert-tabs-profile" aria-selected="false">รายงานบบที่ 2 มีภาพประกอบ</a>
</div>
    </div>
    <div class="col-9">
    <?php if ($searchModel->q_date): ?>
    <div class="tab-content" id="vert-tabs-tabContent">
<div class="tab-pane text-left fade active show" id="vert-tabs-home" role="tabpanel" aria-labelledby="vert-tabs-home-tab">
                <h1 id="loading" class="text-center mt-5"> <i class="fas fa-circle-notch fa-spin"></i> กำลังโหลด...</h1>
                <div id="view-frame">
                    <?php echo '<p>' . Html::a('ดาวน์โหลดเอกสาร', Url::to(Yii::getAlias('@web') . '/msword/ms_word_result.docx'), ['class' => 'btn btn-info']) .
        '</p><iframe src="https://docs.google.com/viewerng/viewer?url=' . Url::to(Yii::getAlias('@web') . '/msword/ms_word_result.docx', true) . '&embedded=true"  style="position: absolute;width:100%; height:500px;border: none;"></iframe>';?>
                </div>

</div>
<div class="tab-pane fade" id="vert-tabs-profile" role="tabpanel" aria-labelledby="vert-tabs-profile-tab">
<?php echo '<p>' . Html::a('ดาวน์โหลดเอกสาร', Url::to(Yii::getAlias('@web') . '/msword/ms_word_result2.docx'), ['class' => 'btn btn-info']) .
        '</p><iframe src="https://docs.google.com/viewerng/viewer?url=' . Url::to(Yii::getAlias('@web') . '/msword/ms_word_result2.docx', true) . '&embedded=true"  style="position: absolute;width:100%; height:500px;border: none;"></iframe>';?>

</div>

</div>
<?php endif; ?>

 

    </div>
</div>

<?php
$js = <<< JS
// window.onbeforeunload = function () { 
//    console.log("onbeforeunload");
//  }
$('#view-frame').hide()
$('#loading').show();
$(window).on('load', function() {
    $('#loading').hide();
console.log('loading');
$('#view-frame').show()
  });
 


JS;
$this->registerJs($js);
?>