<?php
use yii\web\View;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

$this->title = 'ลงทะเบียน';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container p-3">
    <div class="row d-flex justify-content-center">
        <img id="pictureUrl" class="rounded-circle" width="25%">
    </div>
    <div class="row d-flex justify-content-center">
        ท่านเคยลงทะเบียนโทรศัพท์ไว้ในระบบแล้ว
    </div>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'registerForm','action' => ['save-user']]); ?>
            <?= $form->field($model, 'line_id')->hiddenInput(['maxlength' => true,'id' =>'line_id'])->label(false); ?>
            <?= $form->field($model, 'id')->hiddenInput(['maxlength' => true])->label(false) ?>
                <div class="form-group">
                    <?= Html::submitButton('ยืนยันการลงทะเบียนด้วย Line', ['class' => 'btn btn-block btn-primary', 'name' => 'signup-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>


<?php 
$js = <<< JS


$('body').on('beforeSubmit', 'form#registerForm', function() {
    var form = $(this);
    if (form.find('.has-error').length) {
      return false;
    }

    $.ajax({
      url: form.attr('action'),
      type: 'post',
      data: form.serialize(),
      success: function(response) {
        // How to update form with error messages?
        console.log(response)
      }
    });

    return false;
  });

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
