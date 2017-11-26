<?php

namespace app\models\gii;

use Yii;

/**
 * This is the model class for table "{{%document}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $title
 * @property integer $category_id
 * @property string $description
 * @property integer $root
 * @property integer $pid
 * @property integer $model_id
 * @property string $type
 * @property integer $position
 * @property integer $link_id
 * @property integer $cover_id
 * @property integer $display
 * @property integer $deadline
 * @property integer $attach
 * @property integer $view
 * @property integer $comment
 * @property integer $extend
 * @property integer $level
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property Model $model
 * @property User $createdBy
 * @property User $updatedBy
 * @property Category $category
 * @property DocumentArticle $documentArticle
 * @property DocumentDownload $documentDownload
 */
class Document extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%document}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'model_id'], 'required'],
            [['category_id', 'root', 'pid', 'model_id', 'position', 'link_id', 'cover_id', 'display', 'deadline', 'attach', 'view', 'comment', 'extend', 'level', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name', 'title', 'description', 'type'], 'string', 'max' => 255],
            [['model_id'], 'exist', 'skipOnError' => true, 'targetClass' => Model::className(), 'targetAttribute' => ['model_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '标识',
            'title' => '标题',
            'category_id' => '所属分类',
            'description' => '描述',
            'root' => '根节点',
            'pid' => '所属ID',
            'model_id' => '内容模型ID',
            'type' => '内容类型',
            'position' => '推荐位',
            'link_id' => '外链',
            'cover_id' => '封面',
            'display' => '可见性',
            'deadline' => '截至时间',
            'attach' => '附件数量',
            'view' => '浏览量',
            'comment' => '评论数',
            'extend' => '扩展统计字段',
            'level' => '优先级',
            'status' => '数据状态',
            'created_at' => '发布时间',
            'updated_at' => '更新时间',
            'created_by' => '作者',
            'updated_by' => '最后编辑',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModel()
    {
        return $this->hasOne(Model::className(), ['id' => 'model_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentArticle()
    {
        return $this->hasOne(DocumentArticle::className(), ['document_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentDownload()
    {
        return $this->hasOne(DocumentDownload::className(), ['document_id' => 'id']);
    }
}
