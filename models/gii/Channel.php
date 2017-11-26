<?php

namespace app\models\gii;

use Yii;

/**
 * This is the model class for table "{{%channel}}".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $title
 * @property string $url
 * @property integer $order
 * @property string $target
 *
 * @property Channel $parent
 * @property Channel[] $channels
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
            [['parent_id', 'order'], 'integer'],
            [['title'], 'required'],
            [['title', 'url', 'target'], 'string', 'max' => 255],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Channel::className(), 'targetAttribute' => ['parent_id' => 'id']],
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
            'title' => '频道标题',
            'url' => '频道标题',
            'order' => '排序',
            'target' => '是否新窗口打开',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Channel::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChannels()
    {
        return $this->hasMany(Channel::className(), ['parent_id' => 'id']);
    }
}
