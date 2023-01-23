<?php
use yii\helpers\Url;
use yii\helpers\Html;
?>
<h1 class="text-center">ระบบรายงานประจำเดือน</h1>
<div class="row justify-content-center">
    <div class="col-3">
        <?php echo $this->render('_search', ['model' => $searchModel]); ?>

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