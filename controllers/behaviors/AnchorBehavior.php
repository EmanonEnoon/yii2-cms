<?php
/**
 * Created by PhpStorm.
 * User: win
 * Date: 2017/12/2
 * Time: 6:14
 */

namespace app\controllers\behaviors;


use Yii;
use yii\base\Behavior;
use yii\helpers\Url;

class AnchorBehavior extends Behavior
{
    /**
     * 设置url锚点
     */
    public function setAnchor()
    {
        \Yii::$app->getSession()->set('__anchor__', $_SERVER['REQUEST_URI']);
    }

    /**
     * 获取url锚点
     * @param string $default
     * @return mixed|string
     */
    public function getAnchor($default = '')
    {
        $default = $default ? $default : Url::toRoute([Yii::$app->controller->id . '/index']);
        if (Yii::$app->getSession()->has('__anchor__')) {
            return Yii::$app->getSession()->get('__anchor__');
        } else {
            return $default;
        }
    }
}