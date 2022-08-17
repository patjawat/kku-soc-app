<?php

/**
 * Theme login
 */
use app\assets\AppAsset;

use yii\helpers\Html;
AppAsset::register($this);
// $this->registerCssFile('https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="./img/medico.ico" type="image/x-icon" />
        <link rel="shortcut icon" href="./img/medico.ico" type="image/x-icon" />
        <!-- <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet"> -->
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?>:TCDS</title>
        <?php $this->head() ?>
    </head>



    <body class="login-page" style="min-height: 466px;">
    <?php $this->beginBody() ?>

<div class="login-box">

<div class="card card-outline card-primary">
<div class="card-header text-center">
<a href="../../index2.html" class="h1"><b>Admin</b>LTE</a>
</div>
<div class="card-body">
<p class="login-box-msg">Sign in to start your session</p>
<?= $content ?>

<div class="social-auth-links text-center mt-2 mb-3">
<a href="#" class="btn btn-block btn-primary">
<i class="fab fa-facebook mr-2"></i> Sign in using Facebook
</a>
<a href="#" class="btn btn-block btn-danger">
<i class="fab fa-google-plus mr-2"></i> Sign in using Google+
</a>
</div>

<p class="mb-1">
<a href="forgot-password.html">I forgot my password</a>
</p>
<p class="mb-0">
<a href="register.html" class="text-center">Register a new membership</a>
</p>
</div>

</div>

</div>


<?php $this->endBody() ?>

    </body>
</html>
<?php $this->endPage() ?>