<?php
use yii\helpers\Url;
?>
<h1>ระบบรายงานประจำเดือน</h1>
<div class="row">
    <div class="col-3">
        <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    </div>
    <div class="col-9">
        <?php if ($searchModel->q_date): ?>
        <h1 id="loading" class="text-center mt-5"> <i class="fas fa-circle-notch fa-spin"></i> กำลังโหลด...</h1>
        <div id="view-frame">
            <?php  echo '<iframe src="https://docs.google.com/viewerng/viewer?url=' . Url::to(Yii::getAlias('@web') . '/msword/ms_word_result.docx', true) . '&embedded=true"  style="width:98%; height:800px;border: none;"></iframe>';?>
            <?php endif; ?>
        </div>
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