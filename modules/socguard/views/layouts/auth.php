<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\modules\vehicle\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
AppAsset::register($this);
// $myAssetBundle = AppAsset::register($this);
$myAsset = $this->assetManager->getBundle('\\app\modules\vehicle\AppAsset');

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => '@web/favicon.ico']);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<style>


html, body {
    font-family: 'Prompt', sans-serif;
    font-size: 0.95rem;
    background: #fafafa;
    overflow-x: hidden;
    overflow-y: auto;
    letter-spacing: 0.05px;
    font-weight: 200;
    background-color: #29bca5;
}

</style>
<style>

#main{
    /* background-image: url("<?=$myAsset->baseUrl.'/images/bk.jpg'?>"); */
    background-repeat: no-repeat;
    background-size: 1087px 827px;
    background: linear-gradient( 180deg, rgba(178, 223, 219, 0.6965379901960784) 0%, rgba(224, 242, 241, 0) 100% ), URL("<?=$myAsset->baseUrl.'/images/bk.jpg'?>");
    /* background-position-x: right; */
}
.bg-left{
  
    /* background-image: url("<?=$myAsset->baseUrl.'/images/bg-left.png'?>"); */
    /* background-size: cover; */
    width:300px;
    height:300px;
    top: 70px;
    left: 0px;
    position: absolute;

}


</style>

<body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>


        <div class="container">
            <br>

            <?= Alert::widget() ?>

            <!-- Loading-box -->
            <div id="awaitLogin" style="display:none;margin-top:100px">
                <div class="d-flex justify-content-center">
                    <div style="position:relative;width:10%;">
                        <?=Html::img('@web/images/moph_logo.png',['style' => 'position: absolute;width: 100px;top:1px;left:1px;']);?>
                        <div class="dbl-spinner"></div>
                        <div class="dbl-spinner"></div>
                        <h6 style="position: absolute;top:115px;left:8%;">กำลังโหลด...</h6>
                    </div>
                </div>
            </div>

            <div id="content-container">
                <?= $content ?>
            </div>
        </div>
    </main>
    <?php
$js = <<<JS
    AOS.init();
JS;
$this->registerJS($js);
?>
    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>