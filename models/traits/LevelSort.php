<?php
/**
 * Created by PhpStorm.
 * User: win
 * Date: 2017/12/2
 * Time: 2:49
 */

namespace app\models\traits;


trait LevelSort
{
    public static function sort($categories, $pid = null)
    {
        $result = [];
        foreach ($categories as $category) {
            if ($category->parent_id == $pid) {
                $result[] = $category;
                $result = array_merge($result, static::sort($categories, $category->id));
            }
        }

        return $result;
    }
}