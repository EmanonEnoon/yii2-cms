<?php
/**
 * Created by PhpStorm.
 * User: win
 * Date: 2017/11/26
 * Time: 1:18
 */

namespace app\models;


class Model extends \app\models\gii\Model
{
    public function rules()
    {
        $rules = parent::rules();
        $rules[] = [['model_class'], 'validateModelExist'];
        return $rules;
    }

    public function validateModelExist($attribute, $params)
    {
        if (!class_exists($this->model_class)) {
            $this->addError($attribute, 'class ' . $this->model_class . ' 不存在');
        }
    }
}