<?php
/**
 * Created by PhpStorm.
 * User: jingx
 * Date: 2018/1/9/0009
 * Time: 16:16
 */

namespace app\commands;

use Yii;
use yii\console\Controller;

class AppController extends Controller
{
    public $defaultAction = 'init';

    public function actionInit()
    {
        Yii::$app->runAction('g/fresh');
        Yii::$app->runAction('rbac/init');
    }
}