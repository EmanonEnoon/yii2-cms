<?php

use kartik\tabs\TabsX;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Document */
/* @var $form yii\widgets\ActiveForm */
/* @var $modelInfo app\models\Model */
?>

<div class="document-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model) ?>

    <?= TabsX::widget([
        'items' => [
            [
                'label' => '<i class="glyphicon glyphicon-home"></i> 基础',
                'content' => $this->render("$modelInfo->name/_form_basic", [
                    'form' => $form,
                    'model' => $model,
                ]),
                'active' => true
            ],
            [
                'label' => '<i class="glyphicon glyphicon-user"></i> 高级',
                'content' => $this->render("$modelInfo->name/_form_advanced", [
                    'form' => $form,
                    'model' => $model,
                ]),
            ],
        ],
        'position' => TabsX::POS_ABOVE,
        'encodeLabels' => false
    ]); ?>


    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('cms', 'Create') : Yii::t('cms', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            <?= Html::submitButton(Yii::t('cms', 'Save Draft'), ['class' => 'btn btn-success']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>
