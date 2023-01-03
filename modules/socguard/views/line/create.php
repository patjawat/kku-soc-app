<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/** @var yii\web\View $this */
/** @var app\modules\socguard\models\Borrow $model */

$this->title = 'เบิกวิทยุ';
$this->params['breadcrumbs'][] = ['label' => 'Borrows', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="borrow-create">

    <h1>
        <?= Html::encode($this->title) ?>
    
       
    </h1>
 
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php
$checkMe = Url::to(['/socguard/line-auth/checkme']);
$js = <<< JS

$('#btn-save').click(function (e) { 
  e.preventDefault();
  var form = $('#w0');
  $.ajax({
    type: "post",
    url: form.attr('action'),
    data: form.serialize(),
    dataType: "json",
    success: function (response) {
      console.log(response)
    }
  });
  
});

$('#loading').show();
            $('#warp-content').hide();
function runApp() {
      liff.getProfile().then(profile => {
        // document.getElementById("pictureUrl").src = profile.pictureUrl;
        $('#line_id').val(profile.userId)

        $.ajax({
          type: "post",
          url: "$checkMe",
          data: {line_id:profile.userId},
          dataType: "json",
          beforeSend: function(){
            $('#loading').show();
            $('#warp-content').hide();

            $('#awaitLogin').show();
    $('#content-container').hide();
          },
          success: function (response) {
            console.log(response);
            $('#loading').hide();
            $('#warp-content').show();
            $('#awaitLogin').hide();
            $('#content-container').show();
            if(response == true){
              liff.closeWindow();
            }
          }
        });
        
      }).catch(err => console.error(err));
    }

    liff.init({ liffId: "1657785530-Y758y54Q" }, () => {
      if (liff.isLoggedIn()) {
        runApp()
        // getUser();
      } else {
        liff.login();
      }
    }, err => console.error(err.code, error.message));


JS;
$this->registerJs($js,View::POS_END)
?>