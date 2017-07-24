<?php

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');
$redis = require(__DIR__ . '/redis.php');

$config = [
    'id' => 'basic',
    'name' => 'Admin',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language'   => 'zh-CN',
    /*'modules' => [],
    'aliases' => [],
    'as access' => [
        'class' => 'yii\filters\AccessControl',
        'allowActions' => [
            '*'
        ]
    ],*/
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'F9Z6wEHuAdb8nX9d7dzInsiZXD5yU-k6',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\Admin',
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
            'enableAutoLogin' => false,
            'authTimeout'     => 1800
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                    'logFile'=>'@runtime/logs/abnormal.log',
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'logFile'=>'@runtime/logs/normal.log',
                    'levels' => ['info','profile'],
                    'logVars'=>['_GET', '_POST', '_COOKIE']
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'logFile'=>'@runtime/logs/app.log',
                    'levels' => ['trace'],
                    'logVars'=>['_GET', '_POST', '_COOKIE']
                ],
            ],
        ],
        'db' => $db,
        'redis' => $redis,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\PhpManager',
        ],
        'i18n' => [
            'translations' => [
                'common' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'fileMap' => [
                        'common' => 'common.php'
                    ],
                ],
                'button' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'fileMap' => [
                        'button' => 'button.php'
                    ],
                ],
                'module' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'fileMap' => [
                        'module' => 'module.php'
                    ],
                ],
            ],
        ]
    ],
    'params' => $params,
];

if (!YII_ENV_DEV) {
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
    ];
}

return $config;
