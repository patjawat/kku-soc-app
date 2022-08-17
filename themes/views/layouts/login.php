<?php

/**
 * Theme login
 */
use yii\helpers\Html;
\hail812\adminlte3\assets\FontAwesomeAsset::register($this);
app\assets\LoginAsset::register($this);

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
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?>:PPS</title>
    <?php $this->head() ?>
</head>

<body>
    <?php $this->beginBody() ?>
    <?php
                $js = <<<JS
                    AOS.init();
                JS;
                $this->registerJS($js);
                ?>
    <!-- Loading-box -->
    <div id="awaitLogin" style="display:none;margin-top:100px">
        <div class="d-flex justify-content-center">
            <div style="position:relative;width:10%;">
                <?=Html::img('@web/images/cctv-logo.svg',['style' => 'position: absolute;width: 60px;top: 25px;left: 16px;']);?>
                <div class="dbl-spinner"></div>
                <div class="dbl-spinner"></div>
                <h6 style="position: absolute;top:115px;left:8%;">กำลังโหลด...</h6>
            </div>
        </div>
    </div>

    <div id="content-container">
        <?=$content ?>
    </div>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>