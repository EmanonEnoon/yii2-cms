<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * Class Category
 * @property Model $allowedModel
 */
class Category extends \app\models\gii\Category
{
    const ALLOW_PUBLISH_DISABLE = '0';
    const ALLOW_PUBLISH_ONLY_FRONTEND = '1';
    const ALLOW_PUBLISH_ONLY_BACKEND = '2';

    public static $allowPublishes = [
        self::ALLOW_PUBLISH_DISABLE => '不允许',
        self::ALLOW_PUBLISH_ONLY_FRONTEND => '仅允许后台',
        self::ALLOW_PUBLISH_ONLY_BACKEND => '允许前后台',
    ];

    const CHECK_REFUSE = 0;
    const CHECK_REQUIRED = 1;

    public static $checks = [
        self::CHECK_REFUSE => '不需要',
        self::CHECK_REQUIRED => '需要',
    ];

    const DISPLAY_ALL = 1;
    const DISPLAY_INVISIBLE = 0;
    const DISPLAY_ONLY_ADMIN = 2;

    public static $displayLabels = [
        self::DISPLAY_ALL => '所有人可见',
        self::DISPLAY_INVISIBLE => '不可见',
        self::DISPLAY_ONLY_ADMIN => '管理员可见',
    ];

    const reply_Allow = 1;
    const reply_not_Allow = 0;

    public static $replayLabels = [
        self::reply_Allow => '允许',
        self::reply_not_Allow => '不允许',
    ];

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    public function rules()
    {
        $rules = parent::rules();
        $rules[] = [['level'], 'filter', 'filter' => function ($value) {
            if ($this->parent_id) {
                return $this->parent->level + 1;
            }
            return $value;
        }];
        $rules[] = [['modelsID'], 'in', 'skipOnEmpty' => true, 'allowArray' => true, 'range' => function () {
            return ArrayHelper::getColumn(Model::find()->select(['id'])->asArray()->all(), 'id');
        }];
        $rules[] = [['typesID'], 'in', 'skipOnEmpty' => true, 'allowArray' => true, 'range' => [
            Document::TYPE_DUANLUO,
            Document::TYPE_MULU,
            Document::TYPE_THEME,
        ]];
        return $rules;
    }

    public function attributeLabels()
    {
        $parent = parent::attributeLabels();
        $parent['modelsID'] = '绑定文档模型';
        $parent['typesID'] = '允许文档类型';

        return $parent;
    }

    public static function sort($categories, $pid = null)
    {
        $result = [];
        foreach ($categories as $category) {
            if ($category->parent_id == $pid) {
                $result[] = $category;
                $result = array_merge($result, static::sort($categories, $category->id));
            }
        }

        return $result;
    }


    public function getAllowPublishLabel()
    {
        return self::$allowPublishes[$this->allow_publish];
    }

    public function getAllowedModel()
    {
        return Model::findAll(['id' => explode(',', $this->model)]);
    }

    public function allowModel($id)
    {
        return in_array($id, explode(',', $this->model));
    }

    public function getModelsID()
    {
        return explode(',', $this->model);
    }

    public function setModelsID($value)
    {
        if ($value) {
            $this->model = implode(',', $value);
        }
    }

    public function getTypesID()
    {
        return explode(',', $this->type);
    }

    public function setTypesID($value)
    {
        if ($value) {
            $this->type = implode(',', $value);
        }
    }

    /**
     * ```
     * [
     *      'label' => '分类',
     *      'icon' => 'circle-o',
     *      'url' => '#',
     *      'items' => [
     *          ['label' => '博客', 'icon' => 'circle-o', 'url' => ['document/index', 'category_id' => 1],],
     *          ['label' => '生活', 'icon' => 'circle-o', 'url' => ['document/index', 'category_id' => 2],],
     *      ],
     * ],
     * ```
     * @return array
     */
    public static function menu()
    {
        $categories = static::find()->asArray()->all();

        return [
            'label' => '分类',
            'icon' => 'circle-o',
            'url' => '#',
            'items' => static::subMenu($categories),
        ];
    }

    /**
     * @param $categories
     * @param null $root
     * @return array|null
     */
    public static function subMenu($categories, $root = null)
    {
        $result = null;
        foreach ($categories as $category) {
            if ($category['parent_id'] == $root) {
                $item['items'] = static::subMenu($categories, $category['id']);
                $item['label'] = $category['title'];
                $item['icon'] = 'circle-o';
                $item['url'] = is_null($item['items']) ? ['document/index', 'category_id' => $category['id']] : '#';
                $result[] = $item;
            }
        }

        return $result;
    }
}