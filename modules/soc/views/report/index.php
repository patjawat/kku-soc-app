<?php
use yii\helpers\Url;
?>
<h1>ระบบรายงานประจำเดือน</h1>
<div class="row">
    <div class="col-3">
        <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    </div>
    <div class="col-9">
        
    <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
<li class="nav-item">
<a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="true">Home</a>
</li>
<li class="nav-item">
<a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">Profile</a>
</li>

</ul>

<?php if ($searchModel->q_date): ?>
<div class="tab-content" id="custom-content-below-tabContent">
<div class="tab-pane fade active show" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab">

<h1 id="loading" class="text-center mt-5"> <i class="fas fa-circle-notch fa-spin"></i> กำลังโหลด...</h1>
        <div id="view-frame">
            <?php  echo '<iframe src="https://docs.google.com/viewerng/viewer?url=' . Url::to(Yii::getAlias('@web') . '/msword/ms_word_result2.docx', true) . '&embedded=true"  style="width:98%; height:800px;border: none;"></iframe>';?>
        </div>

</div>
<div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">

<?php  echo '<iframe src="https://docs.google.com/viewerng/viewer?url=' . Url::to(Yii::getAlias('@web') . '/msword/ms_word_result2.docx', true) . '&embedded=true"  style="width:98%; height:800px;border: none;"></iframe>';?>

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