<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;

?>

<style>
#typed{
    font-size:25px;
    /* color: #6053d2; */
}
</style>
<!-- <div class="typed-out">Web Developer</div> -->


<div class="form-login">


    <img src="https://i.ibb.co/XWdPc2X/wave-01.png" class="wave" data-aos="fade-right" data-aos-delay="500">
    <div class="container">
        
        <div class="img">
            <img id="band" src="https://i.ibb.co/JvXP8rW/phone.png" data-aos="fade-down" data-aos-delay="1000">
        </div>
        <div class="login-content">




            <?php
$form = ActiveForm::begin(['id' => 'form-asset','fieldConfig' => [

    'template' => "{input}",

    'options' => ['tag' => false], // remove wrapper tag

],
]);
?>


            <img src="https://i.ibb.co/H4f3Hkv/profile.png">
            <!-- <h2 class="title typed-out">กรุณายืนยันตัวตนเพื่อเข้าสู่ระบบ</h2> -->
    <div>
    <div id="typed-strings">
  <h1>Welcome</h1>
  <h1>กรุณายืนยันตัวตนเพื่อเข้าสู่ระบบ.</h1>
</div>
<span id="typed"></span>
    </div>


    
            
            <div class="input-div one">
                <div class="i">
                    <i class="fas fa-user"></i>
                </div>
                <div class="div">
                    <h5>Username</h5>
                    <?=$form->field($model, 'username')->textInput(['class' => 'input'])->label(false);?>
                </div>
            </div>
            <div class="input-div pass">
                <div class="i">
                    <i class="fas fa-lock"></i>
                </div>
                <div class="div">
                    <h5>Password</h5>
                    <?=$form->field($model, 'password')->passwordInput(['class' => 'input'])->label(false);?>

                </div>
            </div>
            <?=Html::submitButton('Login', ['class' => 'btn btn-block btn-primary', 'name' => 'login-button', 'tabindex' => '3'])?>
   
<?php $authAuthChoice = yii\authclient\widgets\AuthChoice::begin(['baseAuthUrl' => ['auth/auth']]); ?>

<?php foreach ($authAuthChoice->getClients() as $client): ?>
    <?php
    echo $authAuthChoice->clientLink($client, 'Login with '.ucfirst($client->getName()), ['class' => 'btn btn-danger btn-block']) ?>
<?php endforeach; ?>

<?php yii\authclient\widgets\AuthChoice::end(); ?>
            <a href="#">Forgot Password?</a>
            <?php ActiveForm::end();?>
        </div>
    </div>
</div>



<?php
$js = <<< JS
  var typed = new Typed('#typed', {
    stringsElement: '#typed-strings',
    typeSpeed: 30,
    startDelay: 1000,
    loop: false,
  });

$('#awaitLogin').hide();
$('#form-asset').on('beforeSubmit', function (e) {
    $('#awaitLogin').show();
    $('.form-login').hide();
	return true;
});
JS;
$this->registerJS($js, yii\web\View::POS_END)
?>