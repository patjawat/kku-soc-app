<?php
use yii\web\View;
use yii\helpers\Url;
/** @var yii\web\View $this */
$this->title = "ลงทะเบียน";
?>
line

<img id="pictureUrl" width="25%">
  <p id="userId"></p>
  <p id="displayName"></p>
  <p id="statusMessage"></p>
  <p id="getDecodedIDToken"></p>

  <span id="logout" class="btn btn-danger">Logoutxxx</span>

<div id="register">uu</div>
<?php
$urlProfile = Url::to(['/socguard/line-auth']);
$js = <<< JS
function runApp() {
      liff.getProfile().then(profile => {
        document.getElementById("pictureUrl").src = profile.pictureUrl;
        document.getElementById("userId").innerHTML = '<b>UserId:</b> ' + profile.userId;
        document.getElementById("displayName").innerHTML = '<b>DisplayName:</b> ' + profile.displayName;
        document.getElementById("statusMessage").innerHTML = '<b>StatusMessage:</b> ' + profile.statusMessage;
        document.getElementById("getDecodedIDToken").innerHTML = '<b>Email:</b> ' + liff.getDecodedIDToken().email;
      }).catch(err => console.error(err));
    }

    liff.init({ liffId: "1657785530-4NYREYM2" }, () => {
      if (liff.isLoggedIn()) {
        runApp()
        getUser();
      } else {
        liff.login();
      }
    }, err => console.error(err.code, error.message));


    $('#logout').click(function (e) { 
      console.log('logged out');
      liff.logout();
      liff.closeWindow();
      // window.location.reload();
      
    });
async function getUser() {
    const profile = await liff.getProfile()

    await $.ajax({
        type: "post",
        url: "$urlProfile",
        beforeSend: function() {
            $('#awaitLogin').show();
            $('.content').hide();
        },
        data:{line_id:profile.userId},
        dataType: "json",
        success: function (response) {
            $('#awaitLogin').hide();
            $('.content').show();
         console.log(response)   
         $('#register').text(response)
         
        }
    });
}


JS;
$this->registerJs($js,View::POS_END)
?>