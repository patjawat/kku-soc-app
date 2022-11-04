<div class="usermanager-default-index">
    <h2><i class="far fa-user"></i> ตั้งค่าผู้ใช้งานระบบ</h2>
</div>

<div class="show-user"></div>

<?php
$js = <<< JS
loadUser();

function loadUser(){
    $.ajax({
        type: "get",
        url: "/usermanager/user",
        dataType: "json",
        beforeSend:function(){
            $('.loading-page').show();
        },
        success: function (response) {
            $('.show-user').html(response);
            $('.loading-page').hide();
        }
    });
}
JS;
$this->registerJS($js);
?>