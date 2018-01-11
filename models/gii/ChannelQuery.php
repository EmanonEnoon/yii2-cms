<?php

namespace app\models\gii;

/**
 * This is the ActiveQuery class for [[Channel]].
 *
 * @see Channel
 */
class ChannelQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Channel[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Channel|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
