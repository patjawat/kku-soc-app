<?php
use yii\helpers\Html;

/**
 * Theme login
 */
\hail812\adminlte3\assets\FontAwesomeAsset::register($this);
\hail812\adminlte3\assets\AdminLteAsset::register($this);
app\modules\line\assets\AppAsset::register($this);
use yii\bootstrap4\Modal;
$this->registerCssFile('https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swa');
$assetDir = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');

$publishedRes = Yii::$app->assetManager->publish('@vendor/hail812/yii2-adminlte3/src/web/js');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- <link rel="icon" href="./img/medico.ico" type="image/x-icon" /> -->
        <!-- <link rel="shortcut icon" href="./img/medico.ico" type="image/x-icon" /> -->
        <!-- <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet"> -->
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?><?=$this->title ? '' : 'งานเทคโนโลยีความปลอยภัย'?></title>
        <?php $this->head() ?>
    </head>
    <body class="container" style="min-height: 512.391px;">
        <?php $this->beginBody() ?>
        <?php \dominus77\sweetalert2\Alert::widget(['useSessionFlash' => true]); ?>
        <div id="awaitLogin" style="display:none;margin-top:100px">
            <div   class="d-flex justify-content-center">
                <div style="position:relative;width:25%;">
                    <?php // Html::img('@web/images/cctv-logo.svg',['style' => 'position: absolute;width: 60px;top: 25px;left: 16px;']);?>
                    <div class="dbl-spinner"></div>
                    <div class="dbl-spinner"></div>
                    <h6 style="position: absolute;top:115px;left:8%;">กำลังโหลด...</h6>
                </div>
            </div>
        </div>
            <div class="content">
              <?= $content ?>
            </div>

        <?php $this->endBody() ?>
        <script>
    AOS.init();
    window.onbeforeunload = function () { 
    $('#main-modal').modal('hide');
    $('#awaitLogin').show();
    $('#content-container').hide();
 }
 
  </script>
    </body>
</html>
<?php $this->endPage() ?>