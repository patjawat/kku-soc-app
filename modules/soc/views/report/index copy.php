<?php
/** @var yii\web\View $this */
?>
<h1>report/indexxxx</h1>

<p>
    You may change the content of this page by modifying
    the file <code><?= __FILE__; ?></code>.
</p>
<?php

function duration($begin,$end){
    $remain=intval(strtotime($end)-strtotime($begin));
    $wan=floor($remain/86400);
    $l_wan=$remain%86400;
    $hour=floor($l_wan/3600);
    $l_hour=$l_wan%3600;
    $minute=floor($l_hour/60);
    $second=$l_hour%60;
    return "ผ่านมาแล้ว ".$wan." วัน ".$hour." ชั่วโมง ".$minute." นาที ".$second." วินาที";
}

    $begin="2008-01-01 00:00:01"; //  วันที่เริ่มนับ
    $end=date("Y-m-d H:i:s"); // วันที่สิ้นสุด
    echo duration($begin,$end); // แสดงผล
?>
xxx