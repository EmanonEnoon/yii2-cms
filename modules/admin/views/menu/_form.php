<?php

use app\models\Menu;
use kartik\widgets\Typeahead;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Menu */
/* @var $form yii\widgets\ActiveForm */

$model->parent_id = $model->parent_id ?: Yii::$app->request->get('parent_id');
?>

<div class="menu-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parent_id')->dropDownList(ArrayHelper::map(Menu::find()->asArray()->all(), 'id', 'name'), ['prompt' => '', 'disabled' => true]) ?>

    <?= $form->field($model, 'route')->widget(Typeahead::className(), [
        'options' => ['placeholder' => '从 / 开始输入 ...'],
        'pluginOptions' => ['highlight' => true],
        'dataset' => [
            [
                'local' => \mdm\admin\models\Menu::getSavedRoutes(),
                'limit' => 10
            ]
        ]
    ]) ?>

    <?= $form->field($model, 'order')->textInput() ?>

    <?= $form->field($model, 'data')->textInput() ?>


    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>
