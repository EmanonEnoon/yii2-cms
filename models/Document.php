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

/**
 * Class Document
 * @package app\models
 * @property integer $toggleStatus
 * @property string $toggleStatusLabel
 * @property Document $prev
 * @property Document $next
 */
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
        $rules[] = [['createdAtDatetime'], 'datetime', 'format' => 'php:Y-m-d H:i'];
        $rules[] = [['deadlineDatetime'], 'datetime', 'format' => 'php:Y-m-d H:i'];
        return $rules;
    }

    public function attributeLabels()
    {
        $parent = parent::attributeLabels();
        $parent['createdAtDatetime'] = '发布时间';
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

    public function getCreatedAtDatetime()
    {
        if ($this->created_at) {
            return date('Y-m-d H:i', $this->created_at);
        }
        return null;
    }

    public function setCreatedAtDatetime($value)
    {
        $this->created_at = $value ? strtotime($value) : '';
    }

    public function getDeadlineDatetime()
    {
        if ($this->deadline) {
            return date('Y-m-d H:i', $this->deadline);
        }
        return null;
    }

    public function setDeadlineDatetime($value)
    {
        $this->deadline = $value ? strtotime($value) : '';
    }

    /**
     * 启用一篇文档
     * @return bool
     */
    public function active()
    {
        $this->status = self::STATUS_ACTIVE;
        return $this->save();
    }

    /**
     * 禁用一篇文档
     * @return bool
     */
    public function disable()
    {
        $this->status = self::STATUS_DISABLE;
        return $this->save();
    }

    /**
     * 审核通过一篇文档
     * @return bool
     */
    public function pass()
    {
        $this->status = self::STATUS_ACTIVE;
        return $this->save();
    }

    /**
     * 删除一篇文档
     * @param bool $hardDelete
     * @return bool
     */
    public function delete($hardDelete = false)
    {
        if ($hardDelete) {
            return parent::delete();
        } else {
            $this->status = self::STATUS_DELETE;
            return $this->save();
        }
    }

    /**
     * 还原一篇文档
     * @return bool
     */
    public function restore()
    {
        $this->status = self::STATUS_ACTIVE;
        return $this->save();
    }

    /**
     * 清空回收站
     * hard delete
     * @return int
     */
    public static function emptyTrash()
    {
        return static::deleteAll(['status' => self::STATUS_DELETE]);
    }

    /**
     * 状态切换的标签
     * @return array
     */
    public function toggleStatusLabels()
    {
        return [
            self::STATUS_ACTIVE => self::$statusLabels[self::STATUS_DISABLE],
            self::STATUS_DISABLE => self::$statusLabels[self::STATUS_ACTIVE],
            self::STATUS_EXAMINE => self::$statusLabels[self::STATUS_ACTIVE],
        ];
    }

    /**
     * 状态切换的值
     * @return array
     */
    public function toggleStatus()
    {
        return [
            self::STATUS_ACTIVE => self::STATUS_DISABLE,
            self::STATUS_DISABLE => self::STATUS_ACTIVE,
            self::STATUS_EXAMINE => self::STATUS_ACTIVE,
        ];
    }

    /**
     * 下一个状态的文标签
     * @return array|mixed
     */
    public function getToggleStatusLabel()
    {
        $labels = $this->toggleStatusLabels();
        if (isset($labels[$this->status])) {
            return $labels[$this->status];
        }

        return null;
    }

    /**
     * 下一个状态的值
     * @return mixed|null
     */
    public function getToggleStatus()
    {
        $nextStatus = $this->toggleStatus();
        if (isset($nextStatus[$this->status])) {
            return $nextStatus[$this->status];
        }

        return null;
    }

    /**
     * 返回上一篇文档
     * @return static
     */
    public function getPrev()
    {
        return static::find()->where(['<', 'id', $this->id])->orderBy('id')->limit(1)->one();
    }

    /**
     * 返回下一篇文档
     * @return static
     */
    public function getNext()
    {
        return static::find()->where(['>', 'id', $this->id])->orderBy('id')->limit(1)->one();
    }


}