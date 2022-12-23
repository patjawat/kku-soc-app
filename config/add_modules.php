<?php

use \kartik\datecontrol\Module;

//เพิ่ม module ที่นี่ที่เดียว
$modules = [];

$modules['datecontrol'] = [
    'class' => 'kartik\datecontrol\Module',
    'displaySettings' => [
        Module::FORMAT_DATE => 'dd/MM/yyyy',
        Module::FORMAT_TIME => 'hh:mm:ss a',
        Module::FORMAT_DATETIME => 'yyyy-MM-dd hh:i:ss',
    ],
    'saveSettings' => [
        Module::FORMAT_DATE => 'php:Y-m-d',
        Module::FORMAT_TIME => 'php:H:i:s',
        Module::FORMAT_DATETIME => 'php:Y-m-d H:i:s',
    ],
    'displayTimezone' => 'Asia/Bangkok',
    'autoWidget' => true,
    'autoWidgetSettings' => [
        Module::FORMAT_DATE => ['type' => 2, 'pluginOptions' => ['autoclose' => true]], // example
        Module::FORMAT_DATETIME => ['type' => 2, 'pluginOptions' => [
                'autoclose' => true,
                'todayHighlight' => true,
                'class' => 'xx'
            ]],
        Module::FORMAT_TIME => [],
    ],]; //Oh

$modules['user'] = [
    'class' => 'dektrium\user\Module',
    'enableUnconfirmedLogin' => true,
    'confirmWithin' => 21600,
    'cost' => 12,
    'admins' => ['admin'],
    'controllerMap' => [
        'login' => [
            'class' => \dektrium\user\controllers\SecurityController::className(),
            'on ' . \dektrium\user\controllers\SecurityController::EVENT_AFTER_LOGIN => function ($e) {
                // Yii::$app->response->redirect(array('/user/security/login'))->send();
                Yii::$app->response->redirect(array('/site/login'))->send();
                Yii::$app->end();
            },
        ],
    ],
];

$modules['dmi'] = ['class' => 'app\modules\dmi\Dmi']; //Oh
//$modules['emr'] = ['class' => 'app\modules\emrs\Emr']; //สลับไปใช้ emr-dev
$modules['gridview'] = ['class' => '\kartik\grid\Module']; //system
$modules['admins'] = ['class' => 'mdm\admin\Module']; // จัดการระบ
$modules['gridviewKrajee'] = ['class' => '\kartik\grid\Module']; //system
$modules['opdvisit'] = ['class' => 'app\modules\opdvisit\Opdvisit']; // การรับบริการผู้ป่วยนอก
$modules['med'] = ['class' => 'app\modules\med\Med']; //jub
$modules['ipd'] = ['class' => 'app\modules\ipd\Module']; //Oh
$modules['settings'] = ['class' => 'app\modules\settings\Settings']; //Oh
$modules['dm'] = ['class' => 'app\modules\dm\Dm']; // ระบบเบาหวาน
$modules['dmindicatorold'] = ['class' => 'app\modules\dmindicatorsold\Dmindicators']; //Oh
$modules['hispatient'] = ['class' => 'app\modules\hispatient\Hispatient',]; // His Patient
$modules['nariform'] = ['class' => 'app\modules\nariform\Nariform']; //form Dev โนรี
$modules['naridoc'] = ['class' => 'app\modules\naridoc\Module']; //form Dev โนรี
$modules['rbac'] = ['class' => 'dektrium\rbac\RbacWebModule']; // จัดการสิทธิของผู้ใช้งาน
$modules['lab'] = ['class' => 'app\modules\lab\Lab'];
$modules['drug'] = ['class' => 'app\modules\drug\Drug'];
$modules['doctorworkbench'] = ['class' => 'app\modules\doctorworkbench\Doctorworkbench']; //ห้องตรวจแพทย์
$modules['setsession'] = ['class' => 'app\modules\setsession\SetSession']; //tehnn
$modules['chiefcomplaint'] = ['class' => 'app\modules\chiefcomplaint\Chiefcomplaint']; //ซักประวัติหน้าห้องตรวจ
$modules['dmassessment'] = ['class' => 'app\modules_nurse\dmassessment\Dmassessment']; // 
$modules['usermanager'] = ['class' => 'app\modules\usermanager\Module']; //จัดการผู้ใช้งานระบบ
$modules['document'] = ['class' => 'app\modules\document\Document']; // แสดงเอกการ Scan จากระบบ HIM
$modules['systems'] = ['class' => 'app\modules\systems\Systensettings']; //การตั้งค่ากำหนดการเชื่อม API
$modules['dashbroad'] = ['class' => 'app\modules\dashbroad\Dashbroad']; //การตั้งค่ากำหนดการเชื่อม API
$modules['emr'] = ['class' => 'app\modules\emr\Emr'];
$modules['his'] = ['class' => 'app\modules\his\Module'];
$modules['soc'] = ['class' => 'app\modules\soc\Module'];
$modules['special'] = ['class' => 'app\modules\special\Module'];
$modules['line'] = ['class' => 'app\modules\line\Module'];
$modules['cctv'] = ['class' => 'app\modules\cctv\Module'];
return $modules;
