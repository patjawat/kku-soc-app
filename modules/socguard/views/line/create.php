<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;


$this->title = 'เบิกวิทยุ';
$this->params['breadcrumbs'][] = ['label' => 'Borrows', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<h1 class="text-center text-success" id="create-success">ส่งคำขอเบิกสำเร็จ</h1>
<div class="borrow-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php
$checkMe = Url::to(['/socguard/line-auth/checkme']);
$addUrl = Url::to(['/socguard/line/add']);
$js = <<< JS

Swal.fire(
  'Good job!',
  'You clicked the button!',
  'success'
)
$('#create-success').hide();
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
          'Good job!',
          'You clicked the button!',
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

$('#loading').show();
$('#warp-content').hide();
// function runApp() {
//       liff.getProfile().then(profile => {
//         // document.getElementById("pictureUrl").src = profile.pictureUrl;
//         $('#line_id').val(profile.userId)

//         $.ajax({
//           type: "post",
//           url: "$checkMe",
//           data: {line_id:profile.userId},
//           dataType: "json",
//           beforeSend: function(){
//             $('#loading').show();
//             $('#warp-content').hide();

//             $('#awaitLogin').show();
//             $('#content-container').hide();
//           },
//           success: function (response) {
//             console.log(response);
//             $('#loading').hide();
//             $('#warp-content').show();
//             $('#awaitLogin').hide();
//             $('#content-container').show();
//             if(response == true){
//               liff.closeWindow();
//             }
//           }
//         });
        
//       }).catch(err => console.error(err));
//     }

//     liff.init({ liffId: "1657785530-Y758y54Q" }, () => {
//       if (liff.isLoggedIn()) {
//         runApp()
//         // getUser();
//       } else {
//         liff.login();
//       }
//     }, err => console.error(err.code, error.message));


JS;
$this->registerJs($js,View::POS_END)
?>