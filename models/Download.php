<?php
/**
 * Created by PhpStorm.
 * User: win
 * Date: 2017/11/26
 * Time: 1:17
 */

namespace app\models;


/**
 * Class Download
 * @property DownloadAddon $addon
 */
class Download extends Document
{
    const TYPE = 2;

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
     * @return DownloadAddon
     */
    public function getAddon()
    {
        if (($addon = DownloadAddon::findOne($this->id)) === null) {
            $addon = new DownloadAddon();
            $addon->loadDefaultValues();
        }

        return $addon;
    }
}