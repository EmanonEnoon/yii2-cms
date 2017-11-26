<?php
/**
 * Created by PhpStorm.
 * User: win
 * Date: 2017/11/26
 * Time: 4:23
 */

namespace app\models;


use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

class Document extends \app\models\gii\Document
{
    const STATUS_ACTIVE = 1;
    const STATUS_DISABLE = 0;
    const STATUS_DELETE = -1;
    const STATUS_DRAFT = 3;
    const STATUS_EXAMINE = 2;

    public static $statusLabels = [
        self::STATUS_ACTIVE => '启用',
        self::STATUS_DISABLE => '禁用',
        self::STATUS_DELETE => '删除',
        self::STATUS_DRAFT => '草稿',
        self:: STATUS_EXAMINE => '待审核',
    ];
    public static $statusToggles = [
        self::STATUS_ACTIVE => '禁用',
        self::STATUS_DISABLE => '启用',
        self::STATUS_EXAMINE => '通过',
    ];

    const TYPE_MULU = 1;
    const TYPE_THEME = 2;
    const TYPE_DUANLUO = 3;

    public static $typeLabels = [
        self::TYPE_MULU => '目录',
        self::TYPE_THEME => '主题',
        self::TYPE_DUANLUO => '段落',
    ];
    const DISPLAY_NONE = 0;
    const DISPLAY_VISIBLE = 1;

    public static $displayLabels = [
        self::DISPLAY_NONE => '不可见',
        self::DISPLAY_VISIBLE => '所有人可见',
    ];

    const POSITION_LIST = 1;
    const POSITION_CATEGORY = 2;
    const POSITION_INDEX = 4;

    public static $positionLabels = [
        self::POSITION_LIST => '列表推荐',
        self::POSITION_CATEGORY => '频道页推荐',
        self::POSITION_INDEX => '首页推荐',
    ];

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => null,
            ],
            BlameableBehavior::className(),
        ];
    }

    public function rules()
    {
        $rules = parent::rules();
        $rules[] = [['status'], 'default', 'value' => self::STATUS_ACTIVE];
        $rules[] = [['createdDatetime', 'deadlineDatetime'], 'safe'];
        return $rules;
    }

    public function attributeLabels()
    {
        $parent = parent::attributeLabels();
        $parent['createdDatetime'] = '发布时间';
        $parent['deadlineDatetime'] = '截止时间';
        return $parent;
    }

    /**
     * @return string
     */
    public function getTypeLabel()
    {
        return self::$typeLabels[$this->type];
    }

    /**
     * @return string
     */
    public function getStatusLabel()
    {
        return self::$statusLabels[$this->status];
    }

    public function getPositionID()
    {
        return explode(',', $this->position);
    }

    public function setPositionID($value)
    {
        $this->position = implode(',', $value);
    }

    public function getCreatedDatetime()
    {
        return date('Y-m-d H:i:s', $this->created_at ?: time());
    }

    public function setCreatedDatetime($datetime)
    {
        $this->created_at = strtotime($datetime);
    }

    public function getDeadlineDatetime()
    {
        if ($this->deadline) {
            return date('Y-m-d H:i:s', $this->deadline);
        }
        return null;
    }

    public function setDeadlineDatetime($datetime)
    {
        $this->deadline = strtotime($datetime);
    }

    /**
     * @return bool
     */
    public function active()
    {
        $this->status = self::STATUS_ACTIVE;
        return $this->save();
    }

    /**
     * @return bool
     */
    public function disable()
    {
        $this->status = self::STATUS_DISABLE;
        return $this->save();
    }

    /**
     * @return bool
     */
    public function pass()
    {
        $this->status = self::STATUS_ACTIVE;
        return $this->save();
    }

    /**
     * @return bool
     */
    public function delete()
    {
        $this->status = self::STATUS_DELETE;
        return $this->save();
    }

    /**
     * hard delete
     * @return int
     */
    public static function emptyTrash()
    {
        return static::deleteAll(['status' => self::STATUS_DELETE]);
    }
}