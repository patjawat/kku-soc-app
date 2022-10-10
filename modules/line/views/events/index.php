<?php
use yii\web\View;
use yii\helpers\Html;
$title = "ยังไม่รับเรื่อง";
/** @var yii\web\View $this */
?>

<h1 data-aos="fade-down" class="text-center">ยังไม่รับเรื่อง</h1>
<?php $i =  3; ?>
<?php foreach ($models as $model):?>
<div class="card card-widget collapsed-card" data-aos="fade-up" data-aos-delay="<?=($i++)*100?>">
    <div class="card-header">
        <div class="user-block">
<?=Html::img('@web/img/check_item.png',['class' => 'img-circle','data-cfsrc' => '@web/img/check_item.png']);?>
            <span class="username"><?=$model->eventType->name;?></a></span>
            <span class="description">เวลาเกิดเหตุ <?=$model->event_date;?></span>
        </div>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-plus"></i>
            </button>
       
        </div>

    </div>

    <div class="card-body" style="display: none;">
        <button type="button" class="btn btn-default btn-sm"><i class="fas fa-share"></i> Share</button>
        <button type="button" class="btn btn-default btn-sm"><i class="far fa-thumbs-up"></i> Like</button>
        <span class="float-right text-muted">45 likes - 2 comments</span>
    </div>
    <div class="card-footer" style="display: none;">
       
    </div>

</div>
<?php endforeach;?>


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
      await liff.init({ liffId: "1657538565-5Az1zNYA" })
      if (liff.isInClient()) {
        getUserProfile()
      } else {
        if (liff.isLoggedIn()) {
          getUserProfile()
          document.getElementById("btnLogIn").style.display = "none"
          document.getElementById("btnLogOut").style.display = "block"
        } else {
          logIn()
          document.getElementById("btnLogIn").style.display = "block"
          document.getElementById("btnLogOut").style.display = "none"
        }
      }
    }
    main()
    
JS;
$this->registerJS($js,View::POS_END)
?>