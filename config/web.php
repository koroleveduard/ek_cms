<?php
$config = [
    'id' => 'app',
    'defaultRoute' => 'main/default/index',
    'bootstrap' => [
        'settings',
    ],
    'modules' => [
        'backend' => [
            'class' => 'app\modules\backend\Module',
        ],
        'main' => [
            'class' => 'app\modules\main\Module',
        ],
        'user' => [
            'class' => 'app\modules\user\Module',
        ],
        'settings' => [
            'class' => 'app\modules\settings\Module',
        ],
    ],
    'components' => [
        'user' => [
            'identityClass' => 'app\modules\user\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['user/default/login'],
        ],
        'errorHandler' => [
            'errorAction' => 'main/default/error',
        ],
        'request' => [
            'cookieValidationKey' => '',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
        ],
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
