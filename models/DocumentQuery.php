<?php
/**
 * Created by PhpStorm.
 * User: win
 * Date: 2017/11/26
 * Time: 16:32
 */

namespace app\models;


class DocumentQuery extends \app\models\gii\DocumentQuery
{
    /**
     * @var
     */
    public $type;
    /**
     * @param \yii\db\QueryBuilder $builder
     *
     * @return \yii\db\Query
     */
    public function prepare($builder)
    {
        if ($this->type !== null) {
            $this->andWhere(['type' => $this->type]);
        }
        return parent::prepare($builder);
    }
}