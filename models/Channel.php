<?php
/**
 * Created by PhpStorm.
 * User: win
 * Date: 2017/11/26
 * Time: 1:16
 */

namespace app\models;


class Channel extends \app\models\gii\Channel
{
    const TYPE_NAV = 1;

    const TARGET_SELF = 0;
    const TARGET_BLANK = 1;

    public function rules()
    {
        $rules = parent::rules();
        $rules[] = [['level'], 'filter', 'filter' => function ($value) {
            $value = 1;
            if ($this->parent_id) {
                return $this->parent->level + 1;
            }
            return $value;
        }];

        return $rules;
    }

    public static function targets()
    {
        return [
            self::TARGET_SELF => '当前页面打开',
            self::TARGET_BLANK => '新窗口打开',
        ];
    }

    public function types()
    {
        return [
            self::TYPE_NAV => '导航',
        ];
    }

    /**
     * @param array $row
     *
     * @return Channel|NavChannel
     */
    public static function instantiate($row)
    {
        switch ($row['type']) {
            case NavChannel::TYPE:
                return new NavChannel();
            default:
                return new self;
        }
    }
}