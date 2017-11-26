<?php

namespace app\models\gii;

use Yii;

/**
 * This is the model class for table "{{%file}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $path
 * @property string $ext
 * @property string $mime
 * @property string $size
 * @property string $md5
 * @property string $sha1
 * @property string $location
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property DocumentDownload[] $documentDownloads
 */
class File extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%file}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'path'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['name', 'path', 'ext', 'mime', 'size', 'md5', 'sha1', 'location'], 'string', 'max' => 255],
            [['md5'], 'unique'],
            [['sha1'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '原始文件名',
            'path' => '文件保存路径',
            'ext' => '文件后缀',
            'mime' => '文件mime类型',
            'size' => '文件大小',
            'md5' => '文件MD5',
            'sha1' => '文件SHA1',
            'location' => '文件保存位置',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentDownloads()
    {
        return $this->hasMany(DocumentDownload::className(), ['file_id' => 'id']);
    }
}
