<?php
/**
 * Created by PhpStorm.
 * User: jingx
 * Date: 2018/1/11/0011
 * Time: 15:40
 */

namespace app\models;


class NavChannel extends Channel
{
    const TYPE = 1;

    /**
     * @return ChannelQuery
     */
    public static function find()
    {
        return new ChannelQuery(get_called_class(), [
            'where' => ['type' => self::TYPE]
        ]);
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        $this->type = self::TYPE;
        return parent::beforeSave($insert);
    }
}