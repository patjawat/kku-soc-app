<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$modules = require __DIR__ . '/add_modules.php';


$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'thaiFormatter'=>[
            'class'=>'dixonsatit\thaiYearFormatter\ThaiYearFormatter',
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                   '@app/views' => '@app/themes/views'
                ],
            ],
       ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'UDNVjHYuFN4F2HiYRvQjPXW-kbcki6C8',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        // 'user' => [
        //     'identityClass' => 'app\models\User',
        //     'enableAutoLogin' => true,
        // ],
        'user' => [
            'identityClass' => 'mdm\admin\models\User',
            'loginUrl' => ['site/login'],
            'enableAutoLogin' => false,
            'enableSession' => true,
            // ตั้งเวลา timeout 1 ชั่วโมง 60 วินาที * 60 นาที
            // 'authTimeout' => 12960000,
        ],
        'authManager' => [
            'class' => 'dektrium\rbac\components\DbManager',
        ],
        
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],

        'assetManager' => [
			'bundles' => [
				'dosamigos\google\maps\MapAsset' => [
				'options' => [
					'key' => 'AIzaSyB-TGMl0MksmsPlAxetivDyhnlFib5zBzs',// ใส่ API ตรงนี้ครับ
					'language' => 'th',
					'version' => '3.1.18'
					]
				]
			]
		], 
        
        
    ],
    'modules' => $modules,    
    'params' => $params,
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            '*',
            // 'liff/*',
            // 'site/*',
            // 'datecontrol/parse/convert',
            // 'reception/default/index',
            // 'reception/default/form-upload',
            // 'document/documentqr/upload-ajax',
            // 'gii/*',
            // 'api/*'
        ],
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
        'allowedIPs' => ['*'],
    ];
}

return $config;
