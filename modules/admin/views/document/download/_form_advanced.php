<?php

use app\models\Document;
use app\models\DownloadAddon;
use kartik\builder\Form;
use kartik\datecontrol\DateControl;
use kartik\widgets\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Article */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="article-form-advanced">

    <?= $form->field($model, 'type')->radioList(Document::$typeLabels, ['inline' => true]) ?>

    <?= $form->field($model, 'display')->radioList(Document::$displayLabels, ['inline' => true]) ?>

    <?= $form->field($model, "level")->textInput(); ?>

    <?= $form->field($model, 'position')->checkboxList(Document::$positionLabels, ['inline' => true]) ?>

    <?= $form->field($model, 'cover_id')->textInput() ?>

    <?= $form->field($model, 'view')->textInput() ?>

    <?= $form->field($model, 'comment')->textInput() ?>

    <?= $form->field($model, 'createdDatetime')->widget(DateTimePicker::classname(), [
        'pluginOptions' => [
            'autoclose' => true
        ]
    ]); ?>

    <?= $form->field($model, 'deadlineDatetime')->widget(DateTimePicker::classname(), [
        'pluginOptions' => [
            'autoclose' => true
        ]
    ]); ?>

</div>
