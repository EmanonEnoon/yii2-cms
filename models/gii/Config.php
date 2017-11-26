<?php

namespace app\models\gii;

use Yii;

/**
 * This is the model class for table "{{%config}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $type
 * @property string $title
 * @property integer $group
 * @property string $extra
 * @property string $value
 * @property string $comment
 * @property integer $order
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class Config extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%config}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'group'], 'required'],
            [['type', 'group', 'order', 'status', 'created_at', 'updated_at'], 'integer'],
            [['value'], 'string'],
            [['name', 'title', 'extra', 'comment'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '配置名称',
            'type' => '配置类型',
            'title' => '配置说明',
            'group' => '配置分组',
            'extra' => '可选配置值',
            'value' => '配置值',
            'comment' => '配置说明',
            'order' => '排序',
            'status' => '状态',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }
}
