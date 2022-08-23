<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
.form-group {
    margin-bottom: 0.1px;
}

.login-logo,
.register-logo {
    font-size: 1.5rem !important;
}

</style>

<div class="site-login">
    <?php //Html::img('@web/img/logo-theptarin-src.png')?>
    <?php
$form = ActiveForm::begin([
    'layout' => 'horizontal',
    'id' => 'form-asset',
    'options' => ['enctype' => 'multipart/form-data', 'autocomplete' => 'off'],
    'fieldConfig' => [
        'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
        'horizontalCssClasses' => [
            'label' => 'col-sm-0',
            'offset' => 'offset-sm-0',
            'wrapper' => 'col-sm-12',
            'error' => '',
            'hint' => '',
        ],
    ],
]);
?>

    <div class="login-box">
        <div class="login-logo">
            <?php // Html::img('@web/img/Logo-TRH.png');?>
        </div>
        <!-- /.login-logo -->
        <div class="card shadow-lg p-3 mb-5 bg-white rounded">

            <div class="card-body login-card-body">
                <p class="login-box-msg"><i class="fas fa-user-lock"></i>
                    <!-- ยืนยันตัวตนเพื่อเข้าใช้งาน -->
                    Admin-PPS
                </p>
                <form action="../../index3.html" method="post">

                    <?=
$form->field($model, 'username', [
    'inputTemplate' => '<div class="input-group mb-3">
            {input}
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
            </div>',
    'inputOptions' =>
    [
        'autofocus' => 'autofocus',
        'tabindex' => '1',
        'autocomplete' => 'off',
    ],
]
)->label(false);
?>

                    <?=
$form->field($model, 'password', [
    'inputTemplate' => '<div class="input-group mb-3">
            {input}
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
            </div>',
    'inputOptions' =>
    [
        'autofocus' => 'autofocus',
        'tabindex' => '2',
        'autocomplete' => 'off',
    ],
])->passwordInput()->label(false);
?>



                    <div class="social-auth-links text-center mb-3">
                        <?=Html::submitButton('Login', ['class' => 'btn btn-block btn-primary', 'name' => 'login-button', 'tabindex' => '3'])?>

                    </div>
                    <!-- /.social-auth-links -->
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <?php ActiveForm::end();?>


</div>


<?php
$js = <<< JS
$('#awaitLogin').hide();
$('#form-asset').on('beforeSubmit', function (e) {
    $('#awaitLogin').show();
    $('.site-login').hide();
	return true;
});
JS;
$this->registerJS($js, yii\web\View::POS_END)
?>