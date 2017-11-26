<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\forms\SignupForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput() ?>

    <?= $form->field($model, 'email')->textInput() ?>

    <?= $form->field($model, 'password')->textInput() ?>

    <?php // $form->field($model, 'status')->dropDownList(User::$statusLabels, ['inline' => true])  ?>

    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton(Yii::t('cms', 'Create'), ['class' => 'btn btn-success']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>
