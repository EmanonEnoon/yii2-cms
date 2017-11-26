<?php

use app\models\Category;

/* @var $this yii\web\View */
/* @var $model app\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>


<?= $form->field($model, 'display')->radioList(Category::$displayLabels, ['inline' => true]) ?>

<?= $form->field($model, 'reply')->radioList(Category::$replayLabels, ['inline' => true]) ?>

<?= $form->field($model, 'order')->textInput() ?>

<?php /*$form->field($model, 'list_row')->textInput() */ ?>

<?= $form->field($model, 'meta_title')->textInput(['maxlength' => 50]) ?>

<?= $form->field($model, 'keywords')->textInput(['maxlength' => 255]) ?>

<?= $form->field($model, "description")->textarea(['rows' => 6]); ?>

