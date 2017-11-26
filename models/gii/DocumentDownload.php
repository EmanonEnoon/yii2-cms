<?php

namespace app\models\gii;

use Yii;

/**
 * This is the model class for table "{{%document_download}}".
 *
 * @property integer $document_id
 * @property string $parse
 * @property string $content
 * @property integer $file_id
 * @property integer $download
 * @property string $size
 *
 * @property Document $document
 * @property File $file
 */
class DocumentDownload extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%document_download}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['document_id'], 'required'],
            [['document_id', 'file_id', 'download'], 'integer'],
            [['parse', 'content', 'size'], 'string', 'max' => 255],
            [['document_id'], 'exist', 'skipOnError' => true, 'targetClass' => Document::className(), 'targetAttribute' => ['document_id' => 'id']],
            [['file_id'], 'exist', 'skipOnError' => true, 'targetClass' => File::className(), 'targetAttribute' => ['file_id' => 'id']],
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
            'content' => '下载详细描述',
            'file_id' => '文件ID',
            'download' => '下载次数',
            'size' => '文件大小',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocument()
    {
        return $this->hasOne(Document::className(), ['id' => 'document_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFile()
    {
        return $this->hasOne(File::className(), ['id' => 'file_id']);
    }
}
