<?php

use app\models\Config;
use kartik\tabs\TabsX;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Config */
/* @var $group array */

/**
 * @param $group
 * @param $form
 * @return array
 */
$items = function ($group, $form) {
    $items = [];
    foreach ($group as $id => $name) {
        $items[] = [
            'label' => '<i class="glyphicon glyphicon-home"></i> ' . $name . '配置',
            'content' => $this->render('_group', [
                'configs' => Config::findByGroupID($id),
                'form' => $form,
            ]),
        ];
    }
    return $items;
};
?>
<div class="config-group">

    <div class="config-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= TabsX::widget([
            'items' => $items($group, $form),
            'position' => TabsX::POS_ABOVE,
            'encodeLabels' => false
        ]);
        ?>

        <?php if (!Yii::$app->request->isAjax) { ?>
            <div class="form-group">
                <?= Html::submitButton('更新', ['class' => 'btn btn-primary']) ?>
            </div>
        <?php } ?>

        <?php ActiveForm::end(); ?>

    </div>

</div>
