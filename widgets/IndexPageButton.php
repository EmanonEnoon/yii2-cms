<?php
/**
 * Created by PhpStorm.
 * User: win
 * Date: 2017/11/26
 * Time: 4:57
 */

namespace app\widgets;


use yii\base\Widget;
use yii\helpers\Html;

class IndexPageButton extends Widget
{
    /**
     * @var \app\models\Category
     */
    public $category;

    public function run()
    {
        return $this->renderCreateButton() .
            $this->renderResetButton() .
            '{toggleData}' .
            '{export}';
    }

    protected function renderCreateButton()
    {
        $buttons = '';
        foreach ($this->category->allowedModel as $model) {
            $buttons .= Html::a(
                '<i class="glyphicon glyphicon-plus"></i> ' . $model->title,
                ['create', 'category_id' => $this->category->id, 'model_id' => $model->id],
                ['role' => 'modal-remote', 'title' => 'Create new Documents', 'class' => 'btn btn-default']
            );
        }
        return $buttons;
    }

    protected function renderResetButton()
    {
        return Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''],
            ['data-pjax' => 1, 'class' => 'btn btn-default', 'title' => 'Reset Grid']);
    }
}