<?php

namespace app\models\gii;

use Yii;

/**
 * This is the model class for table "{{%channel}}".
 *
 * @property int $id
 * @property int $parent_id 上级频道
 * @property int $type 类型
 * @property string $title 频道标题
 * @property string $url 频道标题
 * @property int $order 排序
 * @property string $target 是否新窗口打开
 */
class Channel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%channel}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'type', 'order'], 'integer'],
            [['title'], 'required'],
            [['title', 'url', 'target'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => '上级频道',
            'type' => '类型',
            'title' => '频道标题',
            'url' => '链接',
            'order' => '排序',
            'target' => '是否新窗口打开',
        ];
    }

    /**
     * @inheritdoc
     * @return ChannelQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ChannelQuery(get_called_class());
    }
}
