<?php
use yii\helpers\Html;
use app\components\UserHelper;
$module = \Yii::$app->controller->module->id;
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
<?php // Html::a(Html::img($assetDir.'/img/AdminLTELogo.png',['class' => 'brand-image img-circle elevation-3','style' => 'opacity: .8']).'<span class="brand-text font-weight-light">AdminPPS</span>',['/'],['class' => 'brand-link']);?>
<?=Html::a(Html::img('@web/images/cctv-logo.svg',['class' => 'brand-image img-circle elevation-3','style' => 'opacity: .8']).'<span class="brand-text font-weight-light">AdminSOC</span>',['/'],['class' => 'brand-link']);?>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
            <i class="far fa-user fa-lg text-white"></i>
                <!-- <img src="<?php // $assetDir?>/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> -->
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= UserHelper::getUser('fullname')?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <!-- href be escaped -->
        <!-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php if($module =='special'):?>
                <?php
            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                    // ['label' => 'Simple Link', 'icon' => 'th', 'badge' => '<span class="right badge badge-danger">New</span>'],
                    // ['label' => 'การติดตามผล','url' => ['/tracking'],'icon' => 'truck'],
                    ['label' => 'Dashboard','url' => ['/special'],'icon' => 'tachometer-alt'],
                    ['label' => 'บันทึกประจำวัน','url' => ['/special/special-event'],'icon' => 'user-edit'],
                                ],
            ]);
            ?>
                <?php endif;?>

                <?php //if($module =='soc'):?>
            <?php
            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                    // ['label' => 'Simple Link', 'icon' => 'th', 'badge' => '<span class="right badge badge-danger">New</span>'],
                    // ['label' => 'การติดตามผล','url' => ['/tracking'],'icon' => 'truck'],
                    ['label' => 'Dashboard','url' => ['/site'],'icon' => 'tachometer-alt'],
                    ['label' => 'ลงทะเบียนขอดูกล้อง','url' => ['/soc/events/user-request'],'icon' => 'user-edit'],
                    ['label' => 'บันทึกเหตุหารณ์','url' => ['/soc/events'],'icon' => 'hiking'],
                    ['label' => 'รายงาน','url' => ['/soc/report'],'icon' => 'chart-line'],
                    ['label' => 'QR-Code','url' => ['/site/qrcode'],'icon' => 'qrcode', 'target' => '_blank'],
                    // ['label' => 'category','url' => ['/category'],'icon' => 'th'],
                    // ['label' => 'step','url' => ['/step'],'icon' => 'th'],
                    // ['label' => 'Yii2 PROVIDED', 'header' => true],
                    // ['label' => 'Login', 'url' => ['site/login'], 'icon' => 'sign-in-alt', 'visible' => Yii::$app->user->isGuest],
                    // ['label' => 'Gii',  'icon' => 'file-code', 'url' => ['/gii'], 'target' => '_blank'],
                    // ['label' => 'Debug', 'icon' => 'bug', 'url' => ['/debug'], 'target' => '_blank'],
                    // ['label' => 'MULTI LEVEL EXAMPLE', 'header' => true],
                    // ['label' => 'Level1'],
                    // [
                        //     'label' => 'Level1',
                        //     'items' => [
                            //         ['label' => 'Level2', 'iconStyle' => 'far'],
                            //         [
                                //             'label' => 'Level2',
                                //             'iconStyle' => 'far',
                                //             'items' => [
                                    //                 ['label' => 'Level3', 'iconStyle' => 'far', 'icon' => 'dot-circle'],
                                    //                 ['label' => 'Level3', 'iconStyle' => 'far', 'icon' => 'dot-circle'],
                                    //                 ['label' => 'Level3', 'iconStyle' => 'far', 'icon' => 'dot-circle']
                                    //             ]
                                    //         ],
                                    //         ['label' => 'Level2', 'iconStyle' => 'far']
                                    //     ]
                                    // ],
                                    // ['label' => 'การตั้งค่า'],
                                    ['label' => 'การตั้งค่า', 'header' => true,'visible' => Yii::$app->user->can('admin')],
                        // ['label' => 'ผู้รับบริการ', 'icon' => 'portrait', 'url' => ['/reception'], 'visible' => Yii::$app->user->can('reception')],
                                    ['label' => 'ตั้งค่าหมวดหมู่','url' => ['/category-type'],'icon' => 'layer-group','visible' => Yii::$app->user->can('admin')],
                                    ['label' => 'ผู้ใช้งาน','url' => ['/usermanager'],'icon' => 'user-cog','visible' => Yii::$app->user->can('admin')],
                                    // ['label' => 'Important', 'iconStyle' => 'far', 'iconClassAdded' => 'text-danger'],
                                    // ['label' => 'Warning', 'iconClass' => 'nav-icon far fa-circle text-warning'],
                                    // ['label' => 'Informational', 'iconStyle' => 'far', 'iconClassAdded' => 'text-info'],
                                ],
            ]);
            ?>
            <?php // endif;?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>