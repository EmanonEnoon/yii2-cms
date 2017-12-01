<?php
/**
 * Created by PhpStorm.
 * User: win
 * Date: 2017/12/2
 * Time: 2:23
 */

namespace app\models;


use app\models\traits\LevelSort;

/**
 * Class Menu
 * @package app\models
 * @property Menu $parent
 */
class Menu extends \app\models\gii\Menu
{
    use LevelSort;

    public function rules()
    {
        $rules = parent::rules();
        $rules[] = [['parent_id'], 'exist', 'targetAttribute' => 'id'];
        $rules[] = [['route'], 'in', 'range' => \mdm\admin\models\Menu::getSavedRoutes(), 'message' => 'Route "{value}" not found.'];
        $rules[] = [['level'], 'filter', 'filter' => function ($value) {
            $value = 1;
            if ($this->parent_id) {
                return $this->parent->level + 1;
            }
            return $value;
        }];

        return $rules;
    }

    public function getParent()
    {
        return $this->hasOne(self::className(), ['id' => 'parent_id']);
    }
}