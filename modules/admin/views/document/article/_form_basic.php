<?php

use kartik\builder\Form;
use kartik\datecontrol\DateControl;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\models\Article */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="article-form-basic">

    <?= $form->field($model, 'title')->textInput(['maxlength' => 40]) ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model->addon, 'content')->widget(CKEditor::className(), ["editorOptions" => ["preset" => "full", "inline" => false]]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

</div>
