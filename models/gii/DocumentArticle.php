<?php

namespace app\models\gii;

use Yii;

/**
 * This is the model class for table "{{%document_article}}".
 *
 * @property integer $document_id
 * @property integer $parse
 * @property string $content
 * @property integer $bookmark
 *
 * @property Document $document
 */
class DocumentArticle extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%document_article}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['document_id', 'content'], 'required'],
            [['document_id', 'parse', 'bookmark'], 'integer'],
            [['content'], 'string'],
            [['document_id'], 'exist', 'skipOnError' => true, 'targetClass' => Document::className(), 'targetAttribute' => ['document_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'document_id' => 'Document ID',
            'parse' => '内容解析类型',
            'content' => '文章内容',
            'bookmark' => '收藏数',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocument()
    {
        return $this->hasOne(Document::className(), ['id' => 'document_id']);
    }
}
