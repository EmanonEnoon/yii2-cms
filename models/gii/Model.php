<?php

namespace app\models\gii;

use Yii;

/**
 * This is the model class for table "{{%model}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $title
 * @property string $namespace
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Document[] $documents
 */
class Model extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%model}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'title', 'namespace'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['name', 'title', 'namespace'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '模型id',
            'name' => '模型标识',
            'title' => '模型名字',
            'namespace' => '命名空间',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocuments()
    {
        return $this->hasMany(Document::className(), ['model_id' => 'id']);
    }
}
