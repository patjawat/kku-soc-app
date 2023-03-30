<?php
use yii\web\View;
use yii\helpers\Url;
/** @var yii\web\View $this */
$this->title = "ลงทะเบียน";
?>
<div id="register"></div>
<?php
$urlProfile = Url::to(['/usermanager/line/profile']);
$js = <<< JS



function logOut() {
      liff.logout()
      window.location.reload()
    }

    function logIn() {
      liff.login({ redirectUri: window.location.href })
    }

    async function getUserProfile() {
      const profile = await liff.getProfile()
        await getUser();
      $('#line_id').val(profile.userId)

    }
    async function main() {
      await liff.init({ liffId: "1657538565-0ll3l5k4" })
      if (liff.isInClient()) {
        getUserProfile()
        console.log('ss');
      } else {
        if (liff.isLoggedIn()) {
            console.log("xx")
          getUserProfile()
        //   document.getElementById("btnLogIn").style.display = "none"
        //   document.getElementById("btnLogOut").style.display = "block"
        } else {
        //   document.getElementById("btnLogIn").style.display = "block"
        //   document.getElementById("btnLogOut").style.display = "none"
        console.log('no');
        logIn()

        }
      }
    }
    main()

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
         $('#register').html(response)
         
        }
    });
}
JS;
$this->registerJs($js,View::POS_END)
?>