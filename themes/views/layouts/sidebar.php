<?php
use yii\helpers\Html;
use app\components\UserHelper;

?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
<?php // Html::a(Html::img($assetDir.'/img/AdminLTELogo.png',['class' => 'brand-image img-circle elevation-3','style' => 'opacity: .8']).'<span class="brand-text font-weight-light">AdminPPS</span>',['/'],['class' => 'brand-link']);?>
<?=Html::a(Html::img('@web/img/logo.png',['class' => 'brand-image img-circle elevation-3','style' => 'opacity: .8']).'<span class="brand-text font-weight-light">AdminSOC</span>',['/'],['class' => 'brand-link']);?>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
            <i class="far fa-user fa-lg text-white"></i>
                <!-- <img src="<?php // $assetDir?>/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> -->
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php //  UserHelper::getUser('fullname')?></a>
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
            <?php
            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                    // ['label' => 'Simple Link', 'icon' => 'th', 'badge' => '<span class="right badge badge-danger">New</span>'],
                    // ['label' => 'การติดตามผล','url' => ['/tracking'],'icon' => 'truck'],
                    ['label' => 'เหตุหารณ์ create','url' => ['/soc/events/user-request'],'icon' => 'user'],
                    ['label' => 'เหตุหารณ์','url' => ['/events'],'icon' => 'user'],
                    ['label' => 'รายงาน','url' => ['/report'],'icon' => 'chart-line'],
                    ['label' => 'บันทึกข้อความขอดูกล้อง','url' => ['/site/qrcode'],'icon' => 'qrcode', 'target' => '_blank'],
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
                                    ['label' => 'การตั้งค่า', 'header' => true],
                                    ['label' => 'ตั้งค่าหมวดหมู่','url' => ['/category-type'],'icon' => 'layer-group'],
                                    ['label' => 'ผู้ใช้งาน','url' => ['/usermanager'],'icon' => 'user-cog'],
                                    // ['label' => 'Important', 'iconStyle' => 'far', 'iconClassAdded' => 'text-danger'],
                                    // ['label' => 'Warning', 'iconClass' => 'nav-icon far fa-circle text-warning'],
                                    // ['label' => 'Informational', 'iconStyle' => 'far', 'iconClassAdded' => 'text-info'],
                                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>