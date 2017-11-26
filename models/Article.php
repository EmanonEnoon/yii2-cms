<?php
/**
 * Created by PhpStorm.
 * User: win
 * Date: 2017/11/26
 * Time: 1:17
 */

namespace app\models;



/**
 * Class Article
 * @property ArticleAddon $addon
 */
class Article extends Document
{
    const TYPE = 1;

    /**
     * @return DocumentQuery
     */
    public static function find()
    {
        return new DocumentQuery(get_called_class(), ['where' =>
            ['type' => self::TYPE]]);
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        $this->type = self::TYPE;
        return parent::beforeSave($insert);
    }

    /**
     * @return ArticleAddon
     */
    public function getAddon()
    {
        if (($addon = ArticleAddon::findOne($this->id)) === null) {
            $addon = new ArticleAddon();
            $addon->loadDefaultValues();
        }

        return $addon;
    }
}