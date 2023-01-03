<?php
use yii\helpers\Url;
use yii\web\View;
?>
<div class="row justify-content-md-center mt-5">
    <h1 class="text-center"><i class="fa-solid fa-user-check"></i> <span class="text-success">ลงทะเบียนสำเร็จ</span>
    </h1>
    <img id="pictureUrl" width="25%">
    <p id="userId"></p>
    <p id="displayName"></p>
    <p id="statusMessage"></p>
    <p id="getDecodedIDToken"></p>
    <div class="d-grid gap-2 col-12 mx-auto">
        <span id="closeLiff" class="btn btn-success">ตกลง</span>
    </div>
</div>

<?php

$js = <<< JS
   $('#closeLiff').click(function (e) { 
liff.closeWindow();
    });


JS;
$this->registerJs($js,View::POS_END)
?>