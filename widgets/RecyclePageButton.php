<?php
/**
 * Created by PhpStorm.
 * User: win
 * Date: 2017/11/26
 * Time: 17:08
 */

namespace app\widgets;

use yii\base\Widget;
use yii\helpers\Html;

class RecyclePageButton extends Widget
{
    public function run()
    {
        return $this->emptyTrashButton() . $this->restoreButton();
    }

    public function emptyTrashButton()
    {
        return Html::a(
            '<i class="glyphicon glyphicon-trash"></i> ' . '清空',
            ['empty-trash'],
            ['role' => 'modal-remote', 'title' => '清空回收站', 'class' => 'btn btn-default', 'data-method' => 'post']
        );
    }

    public function restoreButton()
    {
        return Html::a(
            '<i class="fa fa-fw fa-save"></i> ' . '还原',
            ['restore'],
            ['role' => 'modal-remote', 'title' => '还原', 'class' => 'btn btn-default']
        );
    }
}