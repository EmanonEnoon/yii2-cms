<?php

use app\models\User;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
?>
<div class="user-update">

    <div class="user-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'username')->textInput() ?>

        <?= $form->field($model, 'email')->textInput() ?>

        <?= $form->field($model, 'password')->textInput() ?>

        <?= $form->field($model, 'status')->dropDownList(User::$statusLabels, ['inline' => true]) ?>

        <?php if (!Yii::$app->request->isAjax) { ?>
            <div class="form-group">
                <?= Html::submitButton(Yii::t('cms', 'Update'), ['class' => 'btn btn-primary']) ?>
            </div>
        <?php } ?>

        <?php ActiveForm::end(); ?>

    </div>


</div>
