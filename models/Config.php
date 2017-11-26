<?php
/**
 * Created by PhpStorm.
 * User: win
 * Date: 2017/11/26
 * Time: 17:37
 */

namespace app\models;

/**
 * Class Config
 * @property array $items
 * @property string $groupLabel
 * @property string $typeLabel
 */
class Config extends \app\models\gii\Config
{
    public function getGroupLabel()
    {
        return static::groupList()[$this->group] ?? null;
    }

    public function getTypeLabel()
    {
        return static::typeList()[$this->type] ?? null;
    }

    public static function groupList()
    {
        $config = static::findOne(['name' => 'CONFIG_GROUP_LIST']);
        return self::parse($config->type, $config->value);
    }

    public static function typeList()
    {
        $config = static::findOne(['name' => 'CONFIG_TYPE_LIST']);
        return self::parse($config->type, $config->value);
    }

    protected static function parse($type, $value)
    {
        switch ($type) {
            case 3: //解析数组
                $array = preg_split('/[,;\r\n]+/', trim($value, ",;\r\n"));
                if (strpos($value, ':')) {
                    $value = array();
                    foreach ($array as $val) {
                        list($k, $v) = explode(':', $val);
                        $value[$k] = $v;
                    }
                } else {
                    $value = $array;
                }
                break;
        }
        return $value;
    }

    public static function findByGroupID($groupID)
    {
        return static::find()->where(['status' => 1, 'group' => $groupID])->all();
    }

    public function getItems()
    {
        return self::parseConfigAttr($this->extra);
    }

    protected static function parseConfigAttr($string)
    {
        $array = preg_split('/[,;\r\n]+/', trim($string, ",;\r\n"));
        if (strpos($string, ':')) {
            $value = array();
            foreach ($array as $val) {
                list($k, $v) = explode(':', $val);
                $value[$k] = $v;
            }
        } else {
            $value = $array;
        }
        return $value;
    }
}