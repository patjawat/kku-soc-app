<?php
use yii\web\View;
?>
<div class="line-default-index">
    <h1><?= $this->context->action->uniqueId ?></h1>
    <p>
        This is the view content for action "<?= $this->context->action->id ?>".
        The action belongs to the controller "<?= get_class($this->context) ?>"
        in the "<?= $this->context->module->id ?>" module.
    </p>
    <p>
        You may customize this page by editing the following file:<br>
        <code><?= __FILE__ ?></code>
    </p>
</div>

<h1>Page 2</h1>
  <img id="pictureUrl">
  <button id="btnLogIn" onclick="logIn()">Log In</button>
  <button id="btnLogOut" onclick="logOut()">Log Out</button>
  
<?php 
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
      document.getElementById("pictureUrl").style.display = "block"
      document.getElementById("pictureUrl").src = profile.pictureUrl
    }
    async function main() {
      await liff.init({ liffId: "1657475526-rkbAByAq" })
      if (liff.isInClient()) {
        getUserProfile()
        console.log('ss');
      } else {
        if (liff.isLoggedIn()) {
            console.log("xx")
          getUserProfile()
          document.getElementById("btnLogIn").style.display = "none"
          document.getElementById("btnLogOut").style.display = "block"
        } else {
        //   document.getElementById("btnLogIn").style.display = "block"
        //   document.getElementById("btnLogOut").style.display = "none"
        console.log('no');

        }
      }
    }
    main()
JS;
$this->registerJs($js,View::POS_END);
?>