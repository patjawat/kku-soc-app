<?php

use yii\helpers\Url;
use yii\web\View;
use yii\helpers\Html;

$this->title = 'เบิกวิทยุ/ส่งคืน';
$this->params['breadcrumbs'][] = ['label' => 'Borrows', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<!-- <h1 class="text-center text-success" id="create-success">ส่งคำขอเบิกสำเร็จ</h1> -->
<span id="c"></span>
<?php
// print_r($check->id);
?>
<div class="borrow-createx" id="warp-content">

    <?php if($check):?>
    <?php if ($check->active == 0): ?>
    <h1>สถานะ <?=$model->status_id?></h1>
    <h6><?=$check->created_at?></h6>
    <?php endif;?>
    <!-- สถานะขอเบิก -->
    <?php if ($check->active == 1 && $check->status_id == 1 ): ?>
    <h1 class="text-center">สถานะ <?=$check->status->name?></h1>
    <h6 class="text-center text-danger"><?=$check->created_at?></h6>

    <?php endif;?>

    <!-- สถานะจ่ายให้ -->
    <?php if ($check->active == 1 && $check->status_id == 2 ): ?>
    <h1 class="text-center">สถานะ <?=$check->status->name?></h1>
    <h6 class="text-center text-danger">ขอเบิก<?=$check->created_at?></h6>
    <h1 class="text-center">รหัส : <?=$check->product_id?></h1>

    <h6 class="text-center text-danger">จ่ายให้<?=$check->approve_date?></h6>
    <div class="d-grid gap-2">
        <?=Html::a('ส่งคืน',['/socguard/line/return-to'],['class' => 'btn btn-primary btn-lg btn-block','id' => 'return-to']);?>
    </div>
    <?php endif;?>

    <?php if ($check->active == 1 && $check->status_id == 3 ): ?>
    <h1 class="text-center">สถานะ <?=$check->status->name?></h1>

    <?php endif;?>

    <?php endif;?>





    <?php if (!$check): ?>
    <?=$this->render('_form', [
    'model' => $model,
])?>

    <?php endif;?>


</div>

<?php
$checkMe = Url::to(['/socguard/line-auth/checkme']);
$addUrl = Url::to(['/socguard/line/add']);
$js = <<< JS

$('#warp-content').hide();
$('#awaitLogin').show();
$('#content-container').hide();

$('#return-to').click(function (e) { 
  var form = $('#return-to')
  e.preventDefault();
  $.ajax({
    type: "get",
    url: form.attr('href'),
    dataType: "json",
    beforeSend: function(){
            $('#warp-content').hide();
            $('#awaitLogin').show();
            $('#content-container').hide();
          },
    success: function (response) {
      $('#demo').text(JSON.stringify(response));
      if(response.status == true){
        Swal.fire(
          'บันทึกสำเร็จ!',
          'รอการตรวจสอบ',
          'success',
        )
        setTimeout(
          function()
          {
            liff.closeWindow();
          }, 2000);
      }
    }
  });
  
});

$('#btn-save').click(function (e) {
  e.preventDefault();
  var form = $('#w0');
  $.ajax({
    type: "get",
    url: '$addUrl',
    data: form.serialize(),
    dataType: "json",
    beforeSend: function(){
            $('#warp-content').hide();
            $('#awaitLogin').show();
            $('#content-container').hide();
          },
    success: function (response) {
      if(response.status == true){
        $('#create-success').show();
        $('.borrow-create').text(response.msg);
        $('#awaitLogin').hide();
        $('#content-container').show();
        Swal.fire(
          'บันทึกสำเร็จ!',
          'ส่งคำขอไปยังเจ้าหน้าที่แล้ว!',
          'success',
        )
        setTimeout(
          function()
          {
            liff.closeWindow();
          }, 2000);
        }
    }
  });

});

// $('#loading').show();
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
            if(response.isLogin == false){
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
$this->registerJs($js, View::POS_END)
?>