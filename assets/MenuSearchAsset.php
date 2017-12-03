<?php
/**
 * Created by PhpStorm.
 * User: win
 * Date: 2017/12/3
 * Time: 7:07
 */

namespace app\assets;


use yii\web\AssetBundle;

class MenuSearchAsset extends AssetBundle
{
    public $sourcePath = '@app/assets/menu-search-asset';

    public $js = [
        'menu-search.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];
}