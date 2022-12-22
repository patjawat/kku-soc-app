
<?php 
use yii\web\View;
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
    //   document.getElementById("pictureUrl").style.display = "block"
      document.getElementById("pictureUrl").src = profile.pictureUrl
      console.log(profile)
      $('#line_id').val(profile.userId)
    //   $('#profile').src = profile.pictureUrl;

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
JS;
$this->registerJs($js,View::POS_END);
?>
