<div class="d-flex justify-content-center mt-5">
<h1 class="text-center">Scan Qrcode เพื่อลงบันทึก</h1>
</div>
<div class="d-flex justify-content-center p-3">
    <!-- <img src="" id="view-qrcode" style="width:30%;" /> -->
    <div id="qrcode"></div>

</div>

<?php
use yii\helpers\Url;
use yii\web\View;
$url = Url::to(['/reception/default']);

$js = <<< JS


var qrcode = new QRCode(document.getElementById("qrcode"), {
    text: "https://cssscript.com",
    logo: "http://127.0.0.1:81/img/logo.png",
    width: 240,
						height: 240,
                        correctLevel: QRCode.CorrectLevel.H, // L, M, Q, H
    colorDark: "#000000",
						colorLight: "#ffffff",
				
						PI: '#BF3030',
						PO: '#269926', 
						
						AI: '#009ACD',
						AO: '#B03060',
    titleFont: "bold 16px Arial",
    titleColor: "#000000",
    titleBackgroundColor: "#ffffff",
    titleHeight: 0,
    titleTop: 30, 
    subTitle: "",
    subTitleFont: "14px Arial",
    subTitleColor: "#4F4F4F",
    subTitleTop: 0,
});

// getQrcode();

function getQrcode(){
    $.ajax({
      type: "get",
      url: "qr",
      dataType: "json",
      success: function (response) {
        $('#view-qrcode').attr('src',response);
        console.log(response);
      
      }
    });
  }

JS;
$this->registerJS($js, View::POS_READY);
?>