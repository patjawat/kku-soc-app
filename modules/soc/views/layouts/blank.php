<?php
use yii\helpers\Html;

/**
 * Theme login
 */
\hail812\adminlte3\assets\FontAwesomeAsset::register($this);
\hail812\adminlte3\assets\AdminLteAsset::register($this);
app\assets\AppAsset::register($this);
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
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?>:Hr</title>
        <?php $this->head() ?>
    </head>

    <body style="min-height: 512.391px;background-image: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%)" class="layout-top-nav layout-navbar-fixed">
        <?php $this->beginBody() ?>
        <?php \dominus77\sweetalert2\Alert::widget(['useSessionFlash' => true]); ?>
        <nav class="main-header navbar navbar-expand navbar-light navbar-white">
  <div class="container">
  <a href="../../index3.html" class="navbar-brand">
    <?=Html::img('@web/images/logo.png',['class' => 'brand-image img-circle elevation-3','style' => 'width: 58px;'])?>

<span class="brand-text font-weight-light"> KKU-SOC</span>
</a>

  </div>
</nav>
<!-- /.navbar -->
          <?= $content ?>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>