<?php
/* @var $content string */
use yii\helpers\Html;
use yii\bootstrap4\Breadcrumbs;
use yii\helpers\ArrayHelper;
?>

<?php
/* @var $content string */

//use yii\bootstrap4\Breadcrumbs;
// use dominus77\sweetalert2\Alert;
?>
<?php
// \dominus77\sweetalert2\Alert::widget(['useSessionFlash' => true])
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <?php if (!is_null($this->title)) :?>
            <div class="row">
                <div class="col-sm">
                    <div class="callout callout-info">
                        <p><?php if (!is_null($this->title)) {
                            echo $this->title;
                        } else {
                            echo \yii\helpers\Inflector::camelize(
                                $this->context->id
                            );
                        } ?></p>
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <?php endif; ?>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->

        <!-- Loading-box -->
        <div id="awaitLogin" style="display:none;margin-top:100px">
            <div   class="d-flex justify-content-center">
                <div style="position:relative;width:10%;">
                    <?=Html::img('@web/images/cctv-logo.svg',['style' => 'position: absolute;width: 60px;top: 25px;left: 16px;']);?>
                    <div class="dbl-spinner"></div>
                    <div class="dbl-spinner"></div>
                    <h6 style="position: absolute;top:115px;left:8%;">กำลังโหลด...</h6>
                </div>
            </div>
        </div>
            
    <div class="content pl-3 pr-3">
        <?php if (Yii::$app->session->hasFlash('alert')): ?>
        <?= \yii\bootstrap4\Alert::widget([
        'body' => ArrayHelper::getValue(
            Yii::$app->session->getFlash('alert'),
            'body'
        ),
        'options' => ArrayHelper::getValue(
            Yii::$app->session->getFlash('alert'),
            'options'
        ),
    ]) ?>
        <?php endif; ?>

        <div id="content-container">
            <?= $content ?>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>