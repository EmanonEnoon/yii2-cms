<?php

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require(__DIR__ . './vendor/autoload.php');
require(__DIR__ . './vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . './config/web.php');

$config['components']['assetManager']['baseUrl'] = '@web/web/assets';
$config['components']['assetManager']['basePath'] = '@webroot/web/assets';
$config['components']['assetManager']['bundles']['app\assets\AppAsset'] = [
    'basePath' => '@webroot/web',
    'baseUrl' => '@web/web',
];

(new yii\web\Application($config))->run();
