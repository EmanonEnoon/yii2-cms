<?php

namespace app\models\gii;

use Yii;

/**
 * This is the model class for table "{{%category}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $title
 * @property integer $parent_id
 * @property integer $level
 * @property integer $order
 * @property string $meta_title
 * @property string $keywords
 * @property string $description
 * @property string $model
 * @property string $type
 * @property integer $link_id
 * @property integer $allow_publish
 * @property integer $display
 * @property integer $reply
 * @property integer $check
 * @property string $reply_model
 * @property string $extend
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $status
 * @property integer $icon_id
 *
 * @property Category $parent
 * @property Category[] $categories
 * @property Category $parent0
 * @property Category[] $categories0
 * @property Document[] $documents
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['parent_id', 'level', 'order', 'link_id', 'allow_publish', 'display', 'reply', 'check', 'created_at', 'updated_at', 'icon_id'], 'integer'],
            [['name', 'title', 'meta_title', 'keywords', 'description', 'model', 'type', 'reply_model', 'extend', 'status'], 'string', 'max' => 255],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['parent_id' => 'id']],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['parent_id' => 'id']],
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
            'parent_id' => '上级分类',
            'level' => '层级',
            'order' => '排序',
            'meta_title' => 'SEO的网页标题',
            'keywords' => 'SEO的关键字',
            'description' => '描述',
            'model' => '关联模型',
            'type' => '允许发布的内容类型',
            'link_id' => '外链',
            'allow_publish' => '是否允许发布内容',
            'display' => '可见性',
            'reply' => '是否允许回复',
            'check' => '发布的文章是否需要审核',
            'reply_model' => '回复模型',
            'extend' => '扩展设置',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => '数据状态',
            'icon_id' => '分类图标',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Category::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['parent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent0()
    {
        return $this->hasOne(Category::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories0()
    {
        return $this->hasMany(Category::className(), ['parent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocuments()
    {
        return $this->hasMany(Document::className(), ['category_id' => 'id']);
    }
}
