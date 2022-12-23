<?php
use yii\helpers\Html;
?>
<style>
.u-link > a{
    margin:3px;
}
</style>
<p class="u-link">
<?php // Html::a('<i class="fas fa-traffic-light"></i> เส้นทาง',['/usermanager/router'],['class'=> 'btn btn-primary link-loading'])?>
<?=Html::a('<i class="fas fa-traffic-light"></i> เส้นทาง',['/usermanager/routes'],['class'=> 'btn btn-primary link-loading'])?>
<?=Html::a('<i class="fas fa-user-tag"></i> บทบาท',['/usermanager/role'],['class'=> 'btn btn-danger link-loading'])?>
<?=Html::a('<i class="far fa-user"></i> ผู้ใช้งานระบบ',['/usermanager'],['class'=> 'btn btn-info link-loading'])?>
</p>