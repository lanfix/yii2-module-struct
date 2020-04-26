<?php

use app\components\UserIdentityComponent;
use app\models\User;
use yii\web\AssetManager;

$config = [
    'id' => 'app-web',
    'basePath' => dirname(__DIR__),
    'language' => 'ru-RU',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
        '@root' => __DIR__ . '/../',
        '@uploads' => '@root/public/uploads/'
    ],
    'modules' => [
        'frontend' => [
            'class' => 'app\modules\frontend\Module',
        ],
        'admin' => [
            'class' => 'app\modules\admin\Module',
        ],
    ],
    'defaultRoute' => 'frontend',
    'components' => [
        'request' => [
            'cookieValidationKey' => md5('CHANGE_THIS_STRING'),
            'baseUrl' => ''
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'errorHandler' => [
            'errorAction' => 'frontend/site/error',
        ],
        'assetManager' => [
            'class' => AssetManager::class,
            'linkAssets' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                    'logVars' => []
                ],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<module>/<controller>/<action>/<id:[\d]+>' => '<module>/<controller>/<action>',
            ],
        ],
        'user' => [
            'identityClass' => User::class,
            'class' => UserIdentityComponent::class,
            'enableAutoLogin' => true,
        ],
        'db' => require (__DIR__ . '/db.php')
    ],

];

if(YII_ENV_DEV) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['*'],
    ];
}

return $config;
