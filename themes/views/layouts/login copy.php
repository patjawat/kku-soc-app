<?php

/**
 * Theme login
 */
use yii\helpers\Html;
\hail812\adminlte3\assets\FontAwesomeAsset::register($this);
\hail812\adminlte3\assets\AdminLteAsset::register($this);
app\assets\AppAsset::register($this);

$this->registerCssFile('https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
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
        <title><?= Html::encode($this->title) ?>:PPS</title>
        <?php $this->head() ?>
    </head>
<style>
    body {
        background-color #000000;
background-image linear-gradient(315deg, #000000 0%, #7f8c8d 74%);
    }
</style>
    <body class="login-page" style="min-height: 512.391px;">
        <?php $this->beginBody() ?>
                <!-- Loading-box -->
        <div id="awaitLogin" class="site-login" style="display:none;margin-top: -252px;">
            <div class="d-flex justify-content-center">
                <div style="position:relative;width: 100px;">
                    <?=Html::img('@web/img/logo.png',['style' => 'position: absolute;width: 75px;top: 25px;left: 12px;']);?>
                    <div class="dbl-spinner"></div>
                    <div class="dbl-spinner"></div>
                    <h6 style="position: absolute;top:115px;left:8%;">กำลังโหลด...</h6>
                </div>
            </div>
        </div>
        <div>
            <?=Html::img('@web/img/cropped-logo_mobile-768x109.webp',['style' => 'width:230px'])?>
            <h3>กองป้องกันและรักษาความปลอดภัย</h3>
    
    </div>
        <div id="content-container">

        <?= $content ?>
        </div>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>